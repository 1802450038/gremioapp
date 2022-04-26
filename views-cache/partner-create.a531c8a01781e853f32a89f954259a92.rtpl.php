<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-body">
    <div class="register-box">
        <div class="title-box">
            <h3>Registrar Socio</h3>
        </div>
        <div class="content-box">
            <form method="post" action="/admin/partner/create" class="form-group" enctype="multipart/form-data">
                <div class="input-group">
                    <label for="partner_fullname" class="label-input">Nome completo <span
                            class="mandatory">*</span></label>
                    <input type="text" class="text-input" id="partner_fullname" name="partner_fullname">
                </div>
                <div class="input-group">
                    <label for="partner_cpf" class="label-input">CPF</label>
                    <input type="text" class="text-input cpf" id="partner_cpf" name="partner_cpf">
                </div>
                <div class="input-group">
                    <label for="partner_identity" class="label-input">Identidade</label>
                    <input type="text" class="text-input" id="partner_identity" name="partner_identity">
                </div>
                <div class="input-group">
                    <label for="partner_dtnasc" class="label-input">Data de nascimento</label>
                    <input type="date" class="text-input" id="partner_dtnasc" name="partner_dtnasc">
                </div>
                <div class="input-group">
                    <label for="partner_resphone" class="label-input">Telefone Residencial</label>
                    <input type="text" class="text-input residencial" id="partner_resphone" name="partner_resphone">
                </div>
                <div class="input-group">
                    <label for="partner_mobphone" class="label-input">Telefone Celular</label>
                    <input type="text" class="text-input telefone" id="partner_mobphone" name="partner_mobphone">
                </div>
                <div class="input-group">
                    <label for="partner_email" class="label-input">Email <span class="mandatory">*</span></label>
                    <input type="email" class="text-input" id="partner_email" name="partner_email">
                </div>
                <div class="input-group">
                    <label for="partner_milorganization" class="label-input">Organização Militar <span
                            class="mandatory">*</span></label>
                    <input type="milorganization" class="text-input" id="partner_milorganization"
                        name="partner_milorganization">
                </div>
                <div class="input-group">
                    <label for="partner_assoctype" class="label-input">Tipo de associação</label>
                    <select type="text" class="text-input" id="partner_assoctype" name="partner_assoctype">
                        <option value="REMIDO">REMIDO
                        <option value="MILITAR COM DESCONTO EM FOLHA">MILITAR COM DESCONTO EM FOLHA
                        <option value="MILITAR SEM DESCONTO EM FOLHA">MILITAR SEM DESCONTO EM FOLHA
                        <option value="CIVIL">CIVIL
                        <option value="PROFESSOR (APEMU)">PROFESSOR (APEMU)
                    </select>
                </div>
                <div class="input-group">
                    <label for="partner_dtassoc" class="label-input">Data de associação</label>
                    <input type="date" class="text-input" id="partner_dtassoc" name="partner_dtassoc">
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