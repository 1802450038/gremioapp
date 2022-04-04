<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-body">
    <div class="profile-body">
        <div class="entity-profile-card">
            <div class="entity-profile-card-top card-category">

                <div class="entity-img">
                    <img src="<?php echo htmlspecialchars( $condutor["conductor_profilepicture"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="" srcset="">
                </div>

                <div class="entity-title">
                    <div class="entity-name">
                        <h3><?php echo htmlspecialchars( $condutor["conductor_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                    </div>
                    <div class="entity-sub-info">
                        <p><?php echo htmlspecialchars( $condutor["conductor_note"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
                    </div>
                </div>

            </div>

            <div class="entity-profile-card-middle card-category">
                <div class="entity-info sub-card-category">
                    <div class="card-category-title">
                        <h3>Condutor</h3>
                    </div>
                    <div class="info-items">

                        <div class="info-box">
                            <h3 class="info-title">Nome</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $condutor["conductor_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">Tag</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $condutor["conductor_uniquetag"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">Identidade</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $condutor["conductor_identity"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">celular</h3>
                            <h3 class="info-value phone-mask"><?php echo htmlspecialchars( $condutor["conductor_phone"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">CPF</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $condutor["conductor_cpf"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">Idade</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $condutor["conductor_age"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">Escolaridade</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $condutor["conductor_schooling"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">Beneficio</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $condutor["conductor_socialbenefit"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">Renda familiar</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $condutor["conductor_familyincome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">Data de registro</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $condutor["conductor_dtregister"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>
                    </div>
                </div>

                <div class="sub-card-category">
                    <div class="row card-category-title">
                        <h3>Imagens</h3>
                    </div>
                    <div class="image-info-box">
                        <div class="img-box">
                            <?php if( $condutor["conductor_profilepicture"] ){ ?>
                            <img src="<?php echo htmlspecialchars( $condutor["conductor_profilepicture"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="">
                            <div class="img-box-caption">
                                <p>Foto perfil</p>
                                <a href="<?php echo htmlspecialchars( $condutor["conductor_profilepicture"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" target="blank">Visualizar</a>
                            </div>
                            <?php }else{ ?>
                            <div class="img-not-found-box">
                                <p>Nenhuma imagem encontrada</p>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="img-box">
                            <?php if( $condutor["conductor_cppicture"] ){ ?>
                            <img src="<?php echo htmlspecialchars( $condutor["conductor_cppicture"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="">
                            <div class="img-box-caption">
                                <p>Imagem direita</p>
                                <a href="<?php echo htmlspecialchars( $condutor["conductor_cppicture"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" target="blank">Visualizar</a>
                            </div>
                            <?php }else{ ?>
                            <div class="img-not-found-box">
                                <p>Nenhuma imagem encontrada</p>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="img-box">
                            <?php if( $condutor["conductor_frontidentitypicture"] ){ ?>
                            <img src="<?php echo htmlspecialchars( $condutor["conductor_frontidentitypicture"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="">
                            <div class="img-box-caption">
                                <p>Foto Identidade frente</p>
                                <a href="<?php echo htmlspecialchars( $condutor["conductor_frontidentitypicture"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" target="blank">Visualizar</a>
                            </div>
                            <?php }else{ ?>
                            <div class="img-not-found-box">
                                <p>Nenhuma imagem encontrada</p>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="img-box">
                            <?php if( $condutor["conductor_backidentitypicture"] ){ ?>
                            <img src="<?php echo htmlspecialchars( $condutor["conductor_backidentitypicture"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="">
                            <div class="img-box-caption">
                                <p>Foto Identidade traseira</p>
                                <a href="<?php echo htmlspecialchars( $condutor["conductor_backidentitypicture"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" target="blank">Visualizar</a>
                            </div>
                            <?php }else{ ?>
                            <div class="img-not-found-box">
                                <p>Nenhuma imagem encontrada</p>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="entity-address sub-card-category">
                    <div class="card-category-title">
                        <h3>Endereço</h3>
                    </div>
                    <?php if( $endereco != false ){ ?>
                    <div class="info-items">

                        <div class="info-box">
                            <h3 class="info-title">Rua</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $endereco["address_road"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">Numero</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $endereco["address_number"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">Complemento</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $endereco["address_complement"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">Bairro</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $endereco["address_district"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">CEP</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $endereco["address_cep"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">Cidade</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $endereco["address_city"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">Estado</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $endereco["address_state"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>
                    </div>
                    <br>
                    <div class="info-items">
                        <div class="new-element-action">
                            <a href="/admin/address/update<?php echo htmlspecialchars( $endereco["address_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                <button class="edit">Editar</button>
                            </a>
                        </div>
                        <div class="new-element-action">
                            <a href="/admin/address/delete<?php echo htmlspecialchars( $endereco["address_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" onclick="return confirm('Deseja realmente excluir este registro?')">
                                <button class="delete">Excluir</button>
                            </a>
                        </div>
                    </div>
                    <?php }else{ ?>
                    <h3 style="padding-left: 30px; padding-bottom: 30px;">Nenhum endereço encontrado</h3>
                    <div class="new-element">
                        <a href="/admin/address/create<?php echo htmlspecialchars( $condutor["conductor_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="new-element-button">
                            <button>
                                Incluir novo
                            </button>
                        </a>
                    </div>
                    <?php } ?>
                </div>

                <div class="entity-profile-bottom-depends sub-card-category">
                    <div class="card-category-title">
                        <h3>Familiares</h3>
                    </div>
                    <?php if( $dependentes != false ){ ?>
                    <div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Grau</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $counter1=-1;  if( isset($dependentes) && ( is_array($dependentes) || $dependentes instanceof Traversable ) && sizeof($dependentes) ) foreach( $dependentes as $key1 => $value1 ){ $counter1++; ?>
                                <tr>
                                    <td><?php echo htmlspecialchars( $value1["dependent_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                    <td><?php echo htmlspecialchars( $value1["dependent_familiarity"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                    <td>
                                        <a href="/admin/dependent/profile<?php echo htmlspecialchars( $value1["dependent_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="small-action-btn">👁</a>
                                        <a href="/admin/dependent/profile<?php echo htmlspecialchars( $value1["dependent_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="action-btn">Visualizar</a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <?php }else{ ?>
                    <h3 style="padding-left: 30px; padding-bottom: 30px;">Nenhum familiar encontrado</h3>
                    <?php } ?>
                    <div class="new-element">
                        <a href="/admin/dependent/create<?php echo htmlspecialchars( $condutor["conductor_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="new-element-button">
                            <button>
                                Incluir novo
                            </button>
                        </a>
                    </div>
                </div>
                <div class="entity-profile-bottom-vehicles sub-card-category">
                    <div class="card-category-title">
                        <h3>Veiculos</h3>
                    </div>
                    <?php if( $carruagens != false ){ ?>
                    <div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Tipo</th>
                                    <th>Identificador</th>
                                    <th>Cor</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $counter1=-1;  if( isset($carruagens) && ( is_array($carruagens) || $carruagens instanceof Traversable ) && sizeof($carruagens) ) foreach( $carruagens as $key1 => $value1 ){ $counter1++; ?>
                                <tr>
                                    <td><?php echo htmlspecialchars( $value1["carriage_type"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                    <td><?php echo htmlspecialchars( $value1["carriage_uniquetag"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                    <td><?php echo htmlspecialchars( $value1["carriage_color"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                    <td>
                                        <a href="/admin/carriage/profile<?php echo htmlspecialchars( $value1["carriage_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="small-action-btn">👁</a>
                                        <a href="/admin/carriage/profile<?php echo htmlspecialchars( $value1["carriage_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="action-btn">Visualizar</a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <?php }else{ ?>
                    <h3 style="padding-left: 30px; padding-bottom: 30px;">Nenhuma carruagem encontrada</h3>
                    <?php } ?>
                    <div class="new-element">
                        <a href="/admin/carriage/create<?php echo htmlspecialchars( $condutor["conductor_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="new-element-button">
                            <button>
                                Incluir novo
                            </button>
                        </a>
                    </div>
                </div>

                <div class="entity-profile-bottom-animals sub-card-category">
                    <div class="card-category-title">
                        <h3>
                            Animais
                        </h3>
                    </div>
                    <?php if( $animais != false ){ ?>
                    <div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Especie</th>
                                    <th>Tag</th>
                                    <th>Pelagem</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $counter1=-1;  if( isset($animais) && ( is_array($animais) || $animais instanceof Traversable ) && sizeof($animais) ) foreach( $animais as $key1 => $value1 ){ $counter1++; ?>
                                <tr>
                                    <td><?php echo htmlspecialchars( $value1["animal_species"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                    <td><?php echo htmlspecialchars( $value1["animal_uniquetag"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                    <td><?php echo htmlspecialchars( $value1["animal_coat"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                    <td>
                                        <a href="/admin/animal/profile<?php echo htmlspecialchars( $value1["animal_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="small-action-btn">👁</a>
                                        <a href="/admin/animal/profile<?php echo htmlspecialchars( $value1["animal_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="action-btn">Visualizar</a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <?php }else{ ?>
                    <h3 style="padding-left: 30px; padding-bottom: 30px;">Nenhum animal encontrado</h3>
                    <?php } ?>
                    <div class="new-element">
                        <a href="/admin/animal/create<?php echo htmlspecialchars( $condutor["conductor_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="new-element-button">
                            <button>
                                Incluir novo
                            </button>
                        </a>
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
                        <div class="new-element-action">
                            <a href="">
                                <button class="print">Visualizar</button>
                            </a>
                        </div>
                        <div class="new-element-action">
                            <a href="/admin/conductor/update<?php echo htmlspecialchars( $condutor["conductor_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                <button class="edit">Editar</button>
                            </a>
                        </div>
                        <div class="new-element-action">
                            <a href="/admin/conductor/delete<?php echo htmlspecialchars( $condutor["conductor_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" onclick="return confirm('Deseja realmente excluir este registro? Todos seus dependetes, endereço e animais serão excluidos')">
                                <button class="delete">Excluir</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</body>
<script src="_js/jquery-3.6.0.min.js"></script>
<script src="_js/index.js"></script>

</html>