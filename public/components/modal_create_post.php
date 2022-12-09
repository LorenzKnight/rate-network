<div>
    <div class="post_uploaded_pic">
        <script src="../js/scriptupload.js"></script>

        <?php 
            //***********************Image Parameters**************************//
            $imageFieldName="pic_name";
            $destinationFolderName="../tmp_images/"; // destination folder
            $fileFieldName="file1"; // Input field name 
            $nameFieldStatus="status1"; // show name of uploaded file
            $progressBarName="progressBar1"; // Progressbar
            $maximumFileSize="0"; // in Bytes, "0" for unlimited. 1000000 Bytes = 1000Kb = 1Mb
            $allowedFileTypes="jpg,png"; // for example "jpg,doc,png", separated by commas, if you put "0" you allow all types
            $limitWidth="0"; // In pixels, "0" means any size allowed
            $limitHigh="0"; // In pixels, "0" means any size allowed
                                                
            $parameterString="'".$imageFieldName."','".$destinationFolderName."','".$fileFieldName."','".$nameFieldStatus."','".$progressBarName."','".$maximumFileSize."','".$allowedFileTypes."','".$limitWidth."','".$limitHigh."'";                              
        ?>
            <div class="post_foto_prev">
                <!-- <img src="" alt="" id="<?= $nombrecampoimagenmostrar; ?>" height="150"> -->
            </div>
        </div>
        <input type="hidden" size="40" name="settings" id="settings">
        <div class="progresbar">
            <progress id="<?= $progressBarName; ?>" value="0" max="80" style="width: 100%;"></progress></br>
            <h5 id="<?= $nameFieldStatus; ?>" style="margin: 0 auto;"></h5>
        </div>
        <div class="upload_buttons">
            <input type="hidden" class="cfield" size="40" name="<?= $imageFieldName; ?>" id="<?= $imageFieldName; ?>" >
            <input type="file" name="<?= $fileFieldName; ?>" id="<?= $fileFieldName; ?>">
            <input type="button" value="Ladda up file" onclick="uploadFile(<?= $parameterString; ?>)">
        </div>
    </div>
    <div class="text_send">
        <textarea class="tfield" type="text" placeholder="Content..." name="post_content" id="post_content" maxlength="2000" cols="65" rows="6"></textarea></br>
        <input type="button" class="button_upload" id="create_post" value="Upload" />
    </div>
</div>