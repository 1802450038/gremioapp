<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-body">
    <div class="row">
        <div class="register-box">
            <div class="title-box">
                <h3>Registrar Endereço</h3>
            </div>
            <div class="content-box">

                <form action="" method="post" class="form-group">
                    <div class="input-group">
                        <label for="address_road" class="label-input">Rua <span class="mandatory">*</span></label>
                        <input type="text" class="text-input" id="address_road" name="address_road">
                    </div>
                    <div class="input-group">
                        <label for="address_number" class="label-input">Numero <span class="mandatory">*</span></label>
                        <input type="text" class="text-input" id="address_number" name="address_number">
                    </div>
                    <div class="input-group">
                        <label for="address_complement" class="label-input">Complemento</label>
                        <input type="text" class="text-input" id="address_complement" name="address_complement">
                    </div>
                    <div class="input-group">
                        <label for="address_district" class="label-input">Bairro <span class="mandatory">*</span></label>
                        <input type="text" class="text-input" id="address_district" name="address_district">
                    </div>
                    <div class="input-group">
                        <label for="address_cep" class="label-input">CEP</label>
                        <input type="text" class="text-input" id="address_cep" name="address_cep">
                    </div>
                    <div class="input-group">
                        <label for="address_city" class="label-input">Cidade</label>
                        <input type="text" class="text-input" id="address_city" name="address_city">
                    </div>
                    <div class="input-group">
                        <label for="address_state" class="label-input">Estado</label>
                        <input list="state-list" type="text" class="text-input" id="name" name="address_state">
                        <datalist id="state-list">
                            <option value="AC">
                            <option value="AL">
                            <option value="AP">
                            <option value="AM">
                            <option value="BA">
                            <option value="CE">
                            <option value="DF">
                            <option value="ES">
                            <option value="GO">
                            <option value="MA">
                            <option value="MT">
                            <option value="MS">
                            <option value="MG">
                            <option value="PA">
                            <option value="PB">
                            <option value="PR">
                            <option value="PE">
                            <option value="PI">
                            <option value="RJ">
                            <option value="RN">
                            <option value="RS">
                            <option value="RO">
                            <option value="RR">
                            <option value="SC">
                            <option value="SP">
                            <option value="SE">
                            <option value="TO">
                        </datalist>
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

</div>