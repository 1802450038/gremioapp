<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-body">
    <div class="register-box">
        <div class="title-box">
            <h3>Registrar usuario</h3>
        </div>
        <div class="content-box">
            <form method="post" action="/admin/user/create" class="form-group" enctype="multipart/form-data">
                <div class="input-group">
                    <label for="user_name" class="label-input">Nome completo <span class="mandatory">*</span></label>
                    <input type="text" class="text-input" id="user_name" name="user_name">
                </div>
                <div class="input-group">
                    <label for="user_sector" class="label-input">Setor</label>
                     <input type="text" class="text-input" id="user_sector" name="user_sector">
                </div>
                <div class="input-group">
                    <label for="user_office" class="label-input">Cargo</label>
                    <input type="text" class="text-input" id="user_office" name="user_office">
                </div>
                <div class="input-group">
                    <label for="user_login" class="label-input">Login <span class="mandatory">*</span></label>
                    <input type="text" class="text-input" id="user_login" name="user_login">
                </div>
                <div class="input-group">
                    <label for="user_email" class="label-input">Email <span class="mandatory">*</span></label>
                    <input type="email" class="text-input" id="user_email" name="user_email">
                </div>
                <div class="input-group">
                    <label for="user_password" class="label-input">Senha <span class="mandatory">*</span></label>
                    <input type="password" class="text-input" id="user_password" name="user_password">
                </div>
                <div class="input-group">
                    <label for="verify_user_password" class="label-input">Senha novamente <span class="mandatory">*</span></label>
                    <input type="password" class="text-input" id="verify_user_password" name="verify_user_password">
                </div>

                <div class="input-group">
                    <label for="user_isadmin" class="label-input">Administrador</label>
                    <select type="text" class="text-input" id="user_isadmin" name="user_isadmin">
                        <option value="SIM">SIM
                        <option value="NÃO" selected>NÃO
                    </select>
                </div>

                <div class="form-mandatory">
                    <p><span class="mandatory">*</span> Campos obrigatorios</p>
                </div>
                <div class="form-action">
                    <button class="action-reset" type="reset" onclick="history.go(-1)">Cancelar</button>
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
