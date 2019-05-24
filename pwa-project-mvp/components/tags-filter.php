<?php
$arrayOfTags = DBTag::getTags();
?>
<!-- Button to activate modal window for tags filter -->
<div class="classFloatingFilterButtonWrap">
    <button type="button" class="btn classSecondaryBackgroundColor text-white waves-effect waves-light classFloatingFilterButton" id="idFilterTagsShowModalButton" data-toggle="modal" data-target="#idFilterTagsModal" data-backdrop="false" title="Filtro de etiquetas" aria-label="Filtro de etiquetas">
        FILTROS
    </button>
</div>
<!-- Modal window for tags filter -->
<div class="modal fade" id="idFilterTagsModal" tabindex="-1" role="dialog" aria-labelledby="idFilterTagsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header border-bottom-0">
                <button type="button" class="close text-white ml-0 mr-auto" id="idFilterTagsHideModalButton" data-dismiss="modal" aria-label="Cerrar">
                    <i class="fas fa-arrow-left fa-xs" aria-hidden="true"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center" aria-label="Filtro de etiquetas">
                    <div class="col-8 col-sm-6">
                        <?php
                        if ($arrayOfTags) {
                            foreach ($arrayOfTags as $tag) {
                                print("<span class=\"btn btn-block btn-elegant waves-effect mb-2 classFilterTagButton\" onclick=\"toggleFilterButton(this)\" disabled>" . $tag . "</span>");
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top-0">
                <button type="button" class="btn btn-lg classSecondaryBackgroundColor text-white waves-effect w-100" data-dismiss="modal" aria-label="Guardar cambios" id="idFilterTagsSaveButton">GUARDAR
                    CAMBIOS</button>
            </div>
        </div>
    </div>
</div>