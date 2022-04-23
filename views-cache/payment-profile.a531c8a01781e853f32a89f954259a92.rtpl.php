<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-body">
    <div class="profile-body">
        <div class="entity-profile-card">
            <div class="entity-profile-card-middle card-category">
                <div class="entity-info sub-card-category">
                    <div class="row card-category-title">
                        <h3>Comprovante</h3>
                    </div>
                    <div class="info-items">
                        <div class="info-box">
                            <h3 class="info-title">Titular</h3>
                            <a href="/admin/partner/profile<?php echo htmlspecialchars( $pagamento["partner_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="profile-action-bt"><?php echo htmlspecialchars( $pagamento["partner_fullname"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a>
                        </div>
                        <div class="info-box">
                            <h3 class="info-title">Idendificador</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $pagamento["payment_uniquetag"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>
                        <div class="info-box">
                            <h3 class="info-title">Pagador</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $pagamento["payment_payer"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>
                        <div class="info-box">
                            <h3 class="info-title">Valor</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $pagamento["payment_value"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">Metodo</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $pagamento["payment_method"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>
                        <div class="info-box">
                            <h3 class="info-title">Data</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $pagamento["payment_dtregister"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>
                        <div class="info-box">
                            <h3 class="info-title">Observação</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $pagamento["payment_note"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>