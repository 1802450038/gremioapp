<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-body">
    <div class="register-box">
        <div class="title-box">
            <h3>Atualizar usuario</h3>
        </div>
        <div class="content-box">
            <form method="post" action="" class="form-group" enctype="multipart/form-data">
                <div class="input-group">
                    <label for="user_name" class="label-input">Nome completo</label>
                    <input type="text" class="text-input" id="user_name" name="user_name" value="<?php echo htmlspecialchars( $usuario["user_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>
                <div class="input-group">
                    <label for="user_login" class="label-input">Login</label>
                    <input type="text" class="text-input" id="user_login" name="user_login" value="<?php echo htmlspecialchars( $usuario["user_login"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>
                <div class="input-group">
                    <label for="user_email" class="label-input">Email</label>
                    <input type="email" class="text-input" id="user_email" name="user_email" value="<?php echo htmlspecialchars( $usuario["user_email"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>
                <?php if( $administrador=='SIM' ){ ?>
                <div class="input-group">
                    <label for="user_office" class="label-input">Cargo</label>
                    <input type="text" class="text-input" id="user_office" name="user_office" value="<?php echo htmlspecialchars( $usuario["user_office"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>
                <div class="input-group">
                    <label for="user_office" class="label-input">Setor</label>
                    <input type="text" class="text-input" id="user_sector" name="user_sector" value="<?php echo htmlspecialchars( $usuario["user_sector"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>  
                <div class="input-group">
                    <label for="user_isadmin" class="label-input">Administrador</label>
                    <select type="text" class="text-input" id="user_isadmin" name="user_isadmin">
                        <option value="SIM" <?php if( $usuario["user_isadmin"]=='SIM' ){ ?>selected<?php } ?>>SIM
                        <option value="NÃO"<?php if( $usuario["user_isadmin"]=='NAO' ){ ?>selected<?php } ?>>NÃO
                    </select>
                </div>
                <?php } ?>
             

                <div class="form-action">
                    <button class="action-reset" type="reset">Cancelar</button>
                    <button class="action-submit" type="submit">Salvar</button>
                </div>
            </form>
        </div>

    </div>
</div>
<script>
    function toggleAdmin(receviedElement) {

        let checkboxes = document.querySelectorAll(".checkbox-single");
        checkboxes.forEach(element => {
            if (element != receviedElement) {
                element.checked = false
            }
        });
    }
</script>
