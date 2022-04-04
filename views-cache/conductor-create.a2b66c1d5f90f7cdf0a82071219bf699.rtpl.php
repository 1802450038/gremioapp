<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-body">
    <div class="register-box">
        <div class="title-box">
            <h3>Registrar condutor</h3>
        </div>
        <div class="content-box">
            <form method="post" action="/admin/conductor/create" class="form-group" enctype="multipart/form-data">
                <div class="input-group">
                    <label for="conductor_name" class="label-input">Nome completo <span class="mandatory">*</span></label>
                    <input type="text" class="text-input" id="conductor_name" name="conductor_name">
                </div>
                <div class="input-group">
                    <label for="conductor_identity" class="label-input">Identidade</label>
                    <input type="text" class="text-input" id="conductor_identity" name="conductor_identity">
                </div>
                <div class="input-group">
                    <label for="conductor_phone" class="label-input">Telefone</label>
                    <input type="text" class="text-input telefone" id="conductor_phone" name="conductor_phone">
                </div>
                <div class="input-group">
                    <label for="conductor_cpf" class="label-input">CPF</label>
                    <input type="text" class="text-input cpf" id="conductor_cpf" name="conductor_cpf">
                </div>
                <div class="input-group">
                    <label for="conductor_age" class="label-input">Idade <span class="mandatory">*</span></label>
                    <input type="text" class="text-input" id="conductor_age" name="conductor_age">
                </div>
                <div class="input-group">
                    <label for="conductor_schooling" class="label-input">Escolaridade</label>
                    <input type="text" class="text-input" id="conductor_schooling" name="conductor_schooling">
                </div>
                <div class="input-group">
                    <label for="conductor_note" class="label-input">Observação</label>
                    <input type="text" class="text-input" id="conductor_note" name="conductor_note">
                </div>

                <div class="input-check-group">
                    <span class="title-check">Possui algum beneficio ?</span>
                    <div class="check-row">
                        <div class="check-item">
                            <label class="check-container">
                                <div class="check-legend">
                                    SIM
                                </div>
                                <input class="checkbox-single toggle-input" type="checkbox" name="yes"
                                    onclick="toggleCheck(this)">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="check-item">
                            <label class="check-container">
                                <div class="check-legend">
                                    NÃO
                                </div>
                                <input class="checkbox-single" type="checkbox" name="no"
                                    onclick="toggleCheck(this)">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="input-group">
                        <label for="benefit" class="label-input">Qual ?</label>
                        <input type="text" id="others" class="check-input text-input" name="benefit" disabled>
                    </div>
                </div>

                <div class="input-group">
                    <label for="conductor_familyincome" class="label-input">Renda familiar</label>
                    <input type="text" class="text-input renda" id="conductor_familyincome" name="conductor_familyincome">
                </div>

                <div class='input-wrapper'>
                    <img class="input-preview">
                    <label for='input-file1'>
                        Selecione uma foto de perfil
                    </label>
                    <input id='input-file1' type='file' value='' name="conductor_profilepicture" onchange="photoPreview(event)" />
                </div>
                <div class='input-wrapper'>
                    <img class="input-preview">
                    <label for='input-file2'>
                        Selecione uma foto do CPF
                    </label>
                    <input id='input-file2' type='file' value='' name="conductor_cppicture" onchange="photoPreview(event)" />
                </div>
                <div class='input-wrapper'>
                    <img class="input-preview">
                    <label for='input-file3'>
                        Selecione uma foto da Identidade Frente 
                    </label>
                    <input id='input-file3' type='file' value='' name="conductor_frontidentitypicture" onchange="photoPreview(event)" />
                </div>
                <div class='input-wrapper'>
                    <img class="input-preview">
                    <label for='input-file4'>
                        Selecione uma foto da Identidade Verso 
                    </label>
                    <input id='input-file4' type='file' value='' name="conductor_backidentitypicture" onchange="photoPreview(event)" />
                </div>
                <div class="form-mandatory">
                    <p><span class="mandatory">*</span> Campos obrigatorios</p>
                </div>
                <div class="form-action">
                    <button class="action-reset" type="reset">Cancelar</button>
                    <button class="action-submit" type="submit">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>