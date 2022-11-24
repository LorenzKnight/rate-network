<div>
    <div class="post_uploaded_pic">
        <script src="../js/scriptupload.js"></script>

        <?php 
            //***********************PARÁMETROS DE IMAGEN**************************//
            $nombrecampoimagen="pic_name";
            $nombrecampoimagenmostrar="fotopic";
            $nombrecarpetadestino="../images/"; //carpeta destino con barra al final
            $nombrecampofichero="file1";
            $nombrecampostatus="status1";
            $nombrebarraprogreso="progressBar1";
            $maximotamanofichero="0"; //en Bytes, "0" para ilimitado. 1000000 Bytes = 1000Kb = 1Mb
            $tiposficheropermitidos="jpg,png"; //  Por ejemplo "jpg,doc,png", separados por comas y poner "0" para permitir todos los tipos
            $limiteancho="0"; // En píxels, "0" significa cualquier tamaño permitido
            $limitealto="0"; // En píxels, "0" significa cualquier tamaño permitido
                                                
            $cadenadeparametros="'".$nombrecampoimagen."','".$nombrecampoimagenmostrar."','".$nombrecarpetadestino."','".$nombrecampofichero."','".$nombrecampostatus."','".$nombrebarraprogreso."','".$maximotamanofichero."','".$tiposficheropermitidos."','".$limiteancho."','".$limitealto."'";                              
        ?>
        <div class="post_foto_prev">
            <img src="" alt="" id="<?php echo $nombrecampoimagenmostrar;?>" height="150">
            </div>
        </div>
        <input type="hidden" size="40" name="settings" id="settings">
        <div class="progresbar">
            <progress id="<?php echo $nombrebarraprogreso;?>" value="0" max="80" style="width: 100%;"></progress></br>
            <h5 id="<?php echo $nombrecampostatus;?>" style="margin: 0 auto;"></h5>
        </div>
        <div class="upload_buttons">
            <input type="hidden" class="cfield" size="40" name="<?php echo $nombrecampoimagen; ?>" id="<?php echo $nombrecampoimagen;?>" >
            <input type="file" name="<?php echo $nombrecampofichero;?>" id="<?php echo $nombrecampofichero;?>">
            <input type="button" value="Ladda up file" onclick="uploadFile(<?php echo $cadenadeparametros;?>)">
        </div>
    </div>
    <div class="text_send">
        <textarea class="tfield" type="text" placeholder="Content..." name="post_content" id="post_content" maxlength="2000" cols="65" rows="6"></textarea></br>
        <input type="button" class="button_upload" id="create_post" value="Upload" />
    </div>
</div>