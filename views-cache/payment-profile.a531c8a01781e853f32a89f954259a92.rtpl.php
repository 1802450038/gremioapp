<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-body">
    <div class="profile-body">
        <div class="entity-profile-card">
            <div class="entity-profile-card-middle card-category">
                <div class="entity-info sub-card-category">
                    <div class="row card-category-title">
                        <h3>Pagamento</h3>
                    </div>
                    <div class="info-items">
                        <div class="info-box">
                            <h3 class="info-title">Titular</h3>
                            <a href="/admin/partner/profile<?php echo htmlspecialchars( $pagamento["partner_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="profile-action-btn"><?php echo htmlspecialchars( $pagamento["partner_fullname"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a>
                        </div>
                        <div class="info-box">
                            <h3 class="info-title">SITUAÇÃO</h3>
                            <?php if( $pagamento["payment_status"] == 'PAGO' ){ ?>
                            <h3 class="info-value" style="color: rgb(66, 230, 66);"><?php echo htmlspecialchars( $pagamento["payment_status"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                            <?php }elseif( $pagamento["payment_status"] == 'ABERTO' ){ ?>
                            <h3 class="info-value" style="color: rgb(250, 238, 68);"><?php echo htmlspecialchars( $pagamento["payment_status"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                            <?php }else{ ?>
                            <h3 class="info-value" style="color: rgb(235, 71, 65);"><?php echo htmlspecialchars( $pagamento["payment_status"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                            <?php } ?>
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
                            <h3 class="info-title">Pago em</h3>
                            
                            <h3 class="info-value"><?php echo getDateForTemplate($pagamento["payment_date"]); ?></h3>
                            
                        </div>
                        <div class="info-box">
                            <h3 class="info-title">Vencimento</h3>
                            <?php if( $pagamento["payment_duedate"] != null ){ ?>
                            <h3 class="info-value"><?php echo getDateForTemplate($pagamento["payment_duedate"]); ?></h3>
                            <?php } ?>
                        </div>
                        <div class="info-box">
                            <h3 class="info-title">Observação</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $pagamento["payment_note"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>
                    </div>
                  
                </div>
                <div class="entity-profile-card-bottom card-category">
                    <div class="entity-profile-bottom-actions sub-card-category">
                        <div class="card-category-title">
                            <h3>
                                Ações
                            </h3>
                        </div>
                    <div class="info-items">
                        <?php if( $pagamento["payment_status"] !='PAGO' ){ ?>
                        <div class="new-element-action">
                            <a href="/admin/payment/pay<?php echo htmlspecialchars( $pagamento["payment_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                <button class="pay">Pagar</button>
                            </a>
                        </div>
                        <?php } ?>
                        <div class="new-element-action">
                            <a href="/admin/payment/delete<?php echo htmlspecialchars( $pagamento["payment_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" onclick="return confirm('Deseja realmente excluir este registro?')">
                                <button class="delete">Excluir</button>
                            </a>
                        </div>
                    </div>
                </div>
                </div>














                
            </div>

        </div>
    </div>
</div>


