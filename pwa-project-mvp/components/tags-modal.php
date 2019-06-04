<?php
$arrayOfTags = DBTag::getTags();
?>
<!-- Modal window for tags selecting -->
<div class="modal fade" id="idTagsModal" tabindex="-1" role="dialog" aria-labelledby="idTagsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header border-bottom-0">
                <button type="button" class="close text-white ml-0 mr-auto" id="idTagsModalCloseButton" data-dismiss="modal" aria-label="Cerrar">
                    <i class="fas fa-arrow-left fa-xs" aria-hidden="true"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center" aria-label="Lista de Etiquetas">
                    <div class="col-8 col-sm-6">
                        <?php
                        if ($arrayOfTags) {
                            foreach ($arrayOfTags as $tag) {
                                print("<span class=\"btn btn-block btn-elegant waves-effect mb-2 classTagsModalTagSpan\" onclick=\"HelperTagsModal.toggleTagSpanInTagsModal(this)\" disabled>" . $tag . "</span>");
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top-0">
                <button type="button" class="btn btn-lg classSecondaryBackgroundColor text-white waves-effect w-100" data-dismiss="modal" aria-label="Guardar cambios" id="idTagsModalSaveButton">GUARDAR
                    CAMBIOS</button>
            </div>
        </div>
    </div>
</div>