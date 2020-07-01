<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Form;
use App\FormContent;
use App\FormDetail;
use App\User;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $form=Form::all();
        $form_detail=FormDetail::all();
        if(request()->segment(1)=='api'){
            if($form){
                return response()->json([
                    'data'=> $form,
                    'error' => false
                ]);
            }else{
                return response()->json([
                    'error' => true
                ]);
            }
        }
        $user=User::where('role_id',1)->get();
        return view('master/merchant_form', compact('form','user','form_detail'));
    }

    public function api_form_detail($id)
    {
        $form_detail=FormDetail::where('form_id',$id)->get();
        if(request()->segment(3)!='detail'){
            if($form_detail){
                foreach($form_detail as $i =>$item){
                    $form_detail[$i]->input_awal=json_decode($item->input_awal);
                }
                return response()->json([
                    'data'=> $form_detail,
                    'error' => false
                ]);
            }else{
                return response()->json([
                    'error' => true
                ]);
            }
        }
        $i=0;
        // return $form_detail."|||||".$id;
        foreach($form_detail as $item){
            $input_awal="";
            if($item->input_awal){
            $input_awal= implode(",",json_decode($item->input_awal,true));
            }
             echo'<tr data-repeater-item>
                <td><input type="text" name="form-detail['.$i.'][nama_kolom]" value="'.$item->nama_kolom.'" class="form-control form-filter input-sm"></td>
                <td>
                    <select name="form-detail['.$i.'][tipe_input]" id="form-field-tipe-'.$i.'">
                        <option value="text">Text</option>
                        <option value="textarea">Long Text</option>
                        <option value="radio">Radio Button</option>
                        <option value="checkbox">Checkbox</option>
                        <option value="selection">Selection</option>
                    </select>
                </td>
                <td>
                    <input type="text" id="form-field-awal-'.$i.'" name="form-detail['.$i.'][input_awal]" value="'.$input_awal.'" class="form-control form-filter input-sm">
                </td>
                <script>
                $("#form-field-tipe-'.$i.'").val("'.$item->tipe_input.'");
                
                if($("#form-field-tipe-'.$i.'").val()=="radio"||$("#form-field-tipe-'.$i.'").val()=="checkbox"||$("#form-field-tipe-'.$i.'").val()=="selection"){
                    $("#form-field-awal-'.$i.'").attr("placeholder","pilihan_1,pilihan_2,....");
                }
                </script>
                <td>
                    <input id="id-button-borders" name="form-detail['.$i.'][status_value]" type="checkbox" class="ace ace-switch ace-switch-5" '.($item->status_value==1 ? 'checked':'').'/>
                    <span class="lbl middle"></span>
                </td>
                <td>
                    <a href="javascript:;" data-repeater-delete class="btn btn-danger mt-repeater-delete">
                        <i class="fa fa-close"></i>
                    </a>
                </td>
            </tr>';
            $i++;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $form = Form::create([
                'user_id'=>$request['user_id'],
                'nama_formulir'=>$request['nama_formulir'],
                'nama_data'=>$request['nama_data'],
                'status_formulir'=>$request['status_formulir'],
            ]);
            for ($i=0; $i < count($request['form-detail']); $i++) {
                $data=[
                  'form_id' => $form->id_form,
                  'nama_kolom' => $request['form-detail'][$i]['nama_kolom'],
                  'tipe_input' => $request['form-detail'][$i]['tipe_input'],
                  'input_awal' => json_encode(explode(',', $request['form-detail'][$i]['input_awal'])),
                  'status_value' => empty($request['form-detail'][$i]['status_value']) ? 0:1,
                ];
                FormDetail::create($data);
            }
            return redirect()->back()->with('success', 'form telah berhasil ditambahkan');
        }catch(Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $form = Form::find($id);
        
        $form->user_id = $request->post('user_id');
        $form->nama_formulir = $request->post('nama_formulir');
        $form->nama_data = $request->post('nama_data');
        $form->status_formulir = $request->post('status_formulir');
        $form->save();
        $form_detail = FormDetail::where('form_id',$id);
        $form_detail->delete();
        for ($i=0; $i < count($request['form-detail']); $i++) {
            $data=[
              'form_id' => $id,
              'nama_kolom' => $request['form-detail'][$i]['nama_kolom'],
              'tipe_input' => $request['form-detail'][$i]['tipe_input'],
              'input_awal' => json_encode(explode(',', $request['form-detail'][$i]['input_awal'])),
              'status_value' => empty($request['form-detail'][$i]['status_value']) ? 0:1,
            ];
            FormDetail::create($data);
        }

        return redirect()->back()->with('success', 'form telah berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $form = Form::find($id);
            $form->delete();
            $form_detail = FormDetail::where('form_id',$id);
            $form_detail->delete();

            return redirect()->back()->with('success', 'form telah berhasil dihapus');
        }catch(Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e
            ]);
        }
    }
}
