<?php 
namespace App\Helpers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use Form;
class Helper
{
    
public static function routes($routes) {
    
    foreach($routes as $key => $route) {
        
        if (is_array($route)) {
            self::route($route[0], $route[1]);
        } else {
            self::route($route);
        }
        self::route($route);
    }
    
}


public static function route($base, $args = []) {
    
    $parts = explode('/', $base);

    if (!isset($model)) {
        $model = end($parts);
    }
    
    if (!isset($controller)) {
        $controller = ucwords($model).'Controller';
    }
    
    if (!isset($basename)) {
        $basename ='';
        foreach($parts as $part) {
            if (!Str::of($part)->contains('{')) {
                $basename .= $part.'.';
            }
        }
    }
    
    if (!isset($pages)) {
        $pages = ['index', 'create', 'show', 'store', 'edit', 'update', 'destroy'];
    }
    $defaultmap = [
            'index' =>  [
                            'method'    => 'get',
                            'path'      => $base,
                            'name'      => 'index',
                        ],
            'create'=>  [
                            'method'    => 'get',
                            'path'      => $base.'/create',
                            'name'      => 'create',
                        ],
            'show'  =>  [
                            'method'    => 'get',
                            'path'      => $base.'/{'.$model.'_id}',
                            'name'      => 'show',
                        ],
            'store' =>  [
                            'method'    => 'post',
                            'path'      => $base,
                            'name'      => 'store',
                        ],
            'edit'  =>  [
                            'method'    => 'get',
                            'path'      => $base.'/{'.$model.'_id}/edit',
                            'name'      => 'edit',
                        ],
            'update'=>  [
                            'method'    => 'put',
                            'path'      => $base.'/{'.$model.'_id}',
                            'name'      => 'update',
                        ],
            'destroy'=> [
                            'method'    => 'delete',
                            'path'      => $base.'/{'.$model.'_id}',
                            'name'      => 'destroy',
                        ],
            ];

    
    if (!isset($map)) {
        $map = $defaultmap;
    } else {
        $map = array_replace_recursive($defaultmap, $map);
    }
    foreach($pages as $page) {
        extract($map[$page]);
        Route::$method($path, $controller.'@'.$page)->name(trim($basename.$name, '.'));
    }
    
}


public static function wrapHtml($group, $args = []){
    switch($group) {
        case 'text_field':
            return '<div class="form-group row">'.
                    Form::label($args['name'],$args['label'],['class' => 'col-sm-12 col-md-2 col-form-label']).
                    '<div class="col-sm-12 col-md-10">'.
                        Form::text($args['name'], $args['value'], ['class' => 'form-control']).
                    '</div>
                </div>';
        break;

        case 'datepicker_field':
            return '<div class="form-group row">'.
                        Form::label($args['name'],$args['label'],['class' => 'col-sm-12 col-md-2 col-form-label']).
                        '<div class="col-sm-12 col-md-10">'.
                        Form::text($args['name'], $args['value'], ['class' => 'form-control']).
                        '</div>
                    </div>';
        break;

        case 'number_field':
            return '<div class="form-group row">'.
                    Form::label($args['name'],$args['label'],['class' => 'col-sm-12 col-md-2 col-form-label']).
                    '<div class="col-sm-12 col-md-10">'.
                        Form::number($args['name'], $args['value'], ['class' => 'form-control', 'min' => 1 ]).
                    '</div>
                </div>';
        break;

        case 'select_field':
            return '<div class="form-group row">'.
                    Form::label($args['name'], $args['label'], ['class' => 'col-sm-12 col-md-2 col-form-label']).
            '<div class="col-sm-12 col-md-10">'.
                Form::select($args['name'], $args['values'] , $args['selected_value'] , ['class'=>'custom-select2 form-control select2-hidden-accessible' , 'style'=>'width:100%' , 'tabindex'=>'-1' , 'aria-hidden'=>'true' ,$args['multiple']]).
            '</div>
        </div>';
        break;

        case 'textarea_field':
            return '<div class="form-group row">'.
                    Form::label($args['name'], $args['label'], ['class' => 'col-sm-12 col-md-2 col-form-label']).
                    '<div class="col-sm-12 col-md-10">'.
                        Form::textarea($args['name'], $args['value'], ['class'=>'form-control']).
                    '</div>
                </div>';
        break;

        case 'button_field':
            return '<div class="form-group row">'.
                        Form::button($args['name'],['type'=>'submit','class' => 'btn btn-primary'] ).
                    '</div>';
        break;

        case 'repeater_field':
            return '<div class="repeater-wrap">'.
                    Form::button('+',['class' => 'btn btn-success addBtn'] ).
                    '<div class="repeater-container">
                        <div class="repeater-fields repeater-to-clone">'.
                         $args['fields'].   
                        '</div>
                    </div>
                </div>';
        break;

        case 'repeater_edit_field':
            return '<div class="repeater-fields">'.
                        Form::button('-',['class' => 'btn btn-danger removeBtn'] ).
                        Form::time('', $args['from_value'], ['class' => 'col-md-5' , 'data-name' => $args['from_name'],  'name' => $args['from_name'] ]).
                        Form::time('', $args['to_value'], ['class' => 'col-md-5' , 'data-name' => $args['to_name'],  'name' => $args['to_name'] ]).
                    '</div>';
        break;

        case 'repeater_label':
            return '<label class="col-sm-12 col-md-2 col-form-label">'.
                    Form::checkbox($args['working_days'], $args['day'] , ['class' => 'working_days']).
                    $args['day'].
                    '<br>'.
                    Form::checkbox($args['working_hours'], $args['day'] , ['class' => 'working_hours_check']).
                    'Working Hours
                </label>';
        break;

        
    } //switch() ends
} //wrapHtml ends

    // public static function table( $args = [] ){
        
    //     $div = '';
    //         $div.='<table id="myTable" class="display">
	// 			<thead>
	// 				<tr>';
    //                     foreach($args['th'] as $heading){
    //                         $div.='<th>'.$heading.'</th>';
    //                     }
	// 				$div .= '</tr>
	// 			</thead>
	// 			<tbody>';
	// 				foreach( $args['tbody_record'] as $key => $tb_rec ){
                        
    //                     $name = ''; $val1 = 0;
    //                     if($args['for'] == 'business') { 
    //                         $name = $tb_rec->title; 
    //                         $val1 = $tb_rec->id;
    //                         $val2 = '';
    //                     } 
    //                     else{
    //                         $name = $tb_rec->name ;
    //                         $val1 = $args['business_id'];
    //                         $val2 = $tb_rec->id;
    //                     }
                        
    //                     $div.='<tr>'.
    //                             '<td>'.$tb_rec->id.'</td>'.
    //                             '<td>'.$name.'</td>'.
    //                             '<td>'.
                                    
    //                                 Helper::modifyButton( 
    //                                     ['edit' => $args['edit'] , 'destroy' => $args['destroy']] , 
    //                                     [ 
    //                                         'val1'  => $val1,
    //                                         'val2'  => $val2
    //                                     ] 
    //                                 ).
    //                             '</td>
    //                         </tr>';
    //                 }
	// 			$div.='</tbody>
    //         </table>';
                    
    //     return $div;
    // }

    public static function modifyButton( $routeName = [] , $args = [] ){
        $div = '';
        $div .= '<a href="'.route($routeName['edit'] , [ $args['val1'] , $args['val2'] ] ).'" class="btn btn-success">'.
            '<i class="fa fa-pencil" aria-hidden="true"></i>'.
        '</a>'.
        
        Form::open([ 'route' => [$routeName['destroy'], $args['val1'], $args['val2'] ], 'method' => 'DELETE']).
            Form::button('<i class="fa fa-trash-o"></i>',['class' => 'btn btn-danger', 'type' => 'submit']).
        Form::close();
        return $div;
    } //modifyButton() ends here

    public static function tableBase( $args = [] ){
        $div = '';
        $div .= '<table id="myTable" class="display">';
        if (isset($args['head'])) {
            $div .= '<thead>
                        <tr>';
                            foreach($args['head'] as $heading){
                                $div .= '<th>'.$heading.'</th>';
                            }
                        $div .= '</tr>
                    </thead>';
        }
        if (isset($args['body'])) {
            $div .= '<tbody>';
            foreach ( $args['body'] as $body ){
                $div .= '<tr>';
                foreach($body as $val ){
                    $div.='<td>'.$val.'</td>';
                }
                $div.='</tr>';
            }
        }
        if (isset($args['foot'])) {
            $div .= '<tfoot>
                        <tr>';
                            foreach($args['foot'] as $heading){
                                $div .= '<th>'.$heading.'</th>';
                            }
                        $div .= '</tr>
                    </tfoot>';
        }
        $div .= '</table>';
        return $div;
    } //baseTable() ends here

    public static function editBtn($args = []){
        return '<a href="'.$args['link'].'" class="btn btn-success">'.
            '<i class="fa fa-pencil" aria-hidden="true"></i>'.
        '</a>';
    }//editBtn() ends 

    public static function destroyBtn( $args = [] ){
        return Form::open([ 'url' => $args['link'] , 'method' => 'DELETE']).
            Form::button('<i class="fa fa-trash-o"></i>',['class' => 'btn btn-danger', 'type' => 'submit']).
        Form::close();
    }

}
