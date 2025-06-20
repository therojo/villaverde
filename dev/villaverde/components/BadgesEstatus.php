<?php
    
    namespace app\components;
    
    use kartik\popover\PopoverX;
    use yii\helpers\Html;

    class BadgesEstatus {
        
        /**
         * [getBadge description]
         * @param  [type]     $type  [description]
         * @param  [type]     $label [description]
         * @return [type]            [description]
         * @author Fabián Muñoz
         * @date   2016-06-01
         */
        public static function getBadge($type, $label, $popOver = NULL){
            
            if(is_null($popOver)){
                return '<span style="line-height: 2;" class="col-sm-12 label label-'.$type.'">'.$label.'</span>';
            }else{
                if($popOver['rechazado']){//Cuando el director rechaza la solicitud.
                    return Html::a($label,["solicitudes/ver-motivo",'idSolicitud' => $popOver['idSolicitud']],['class'=>'btn btn-info approve-w buttonPopOver label label-danger col-sm-12','style' => 'padding: 0px 15px; line-height: 2.5; border: none;','onClick'=>'
                        var tagname = $(this)[0].tagName;
                        $("#modalPopOverRechazado").modal("show").find("#modalContent").load($(this).attr("href"));
                        return false;']);
                }
                if($popOver['solicitud']){
                    return Html::a('DOCS. PENDIENTES',["solicitudes/documentos-faltantes-modal",'idSolicitud' => $popOver['idSolicitud']],['class'=>'btn btn-info approve-w buttonPopOver label label-danger col-sm-12','style' => 'padding: 0px 15px; line-height: 2.5; border: none;','onClick'=>'
                        var tagname = $(this)[0].tagName;
                        $("#modalPopOver").modal("show").find("#modalContent").load($(this).attr("href"));
                        return false;'])." ";
                }else if($popOver['idPaquete']){
                    return Html::a($popOver['estatus'],["paquetes-inversion/adicionar-modal",'idPaquete' => $popOver['idPaquete']],['class'=>'btn btn-info approve-w buttonPopOver label label-danger col-sm-12','style' => 'padding: 0px 15px; line-height: 2.5; border: none;','onClick'=>'
                        var tagname = $(this)[0].tagName;
                        $("#modalPopOverPaquete").modal("show").find("#modalContent").load($(this).attr("href"));
                        return false;'])." ";
                }else{
                    return PopoverX::widget([
                        'header' => $popOver['header'],
                        'type' => PopoverX::TYPE_DANGER,
                        'placement' => PopoverX::ALIGN_TOP,
                        'content' => $popOver['content'],
                        'toggleButton' => [
                            'label'=>$popOver['estatus'], 
                            'class'=>'btn btn-'.$type.' col-sm-12',
                            'style'=>'line-height: 1.7; font-weight: bold; font-size: 75%; padding: 0.2em 0.6em 0.3em;'
                        ],
                    ]);

                }
                
            }
        }
        
    }

?>