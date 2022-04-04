<?php 
include("../seguranca.php");
include("ini.php");
?>
<section>
                            <div class="wizard">
                                <div class="wizard-inner">
                                    <div class="connecting-line"></div>
                                    <ul class="nav nav-tabs" role="tablist">

                                        <li role="presentation" class="active">
                                            <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-folder-open"></i>
                            </span>
                                            </a>
                                        </li>

                                        <li role="presentation" class="disabled">
                                            <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </span>
                                            </a>
                                        </li>
                                        <li role="presentation" class="disabled">
                                            <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-picture"></i>
                            </span>
                                            </a>
                                        </li>

                                        <li role="presentation" class="disabled">
                                            <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-ok"></i>
                            </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <form role="form" action="job/inserir.php" method="post">
                                    <div class="tab-content">
                                        <div class="tab-pane active" role="tabpanel" id="step1">
                                            <h3>Cadastrar</h3>
                                            <label>Tipo de Tarefa</label>
                                            <input type="text" required>
                                            <label>Data de Entrega</label>
                                            <input type="date" required>
                                            <label>Hora de Entrega</label>
                                            <input type="time" required>
                                            <label>Local</label>
                                            <input type="text" required>
                                            <label>Deseja Enviar um Modelo?</label>
                                            <input type="file" >
                                            <label>Observacao</label>
                                            <input type="text" >
                                            <ul class="list-inline pull-right">
                                                <li><button type="button" class="btn btn-primary next-step">Salve e Continue</button></li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane" role="tabpanel" id="step2">
                                            <h3>Cadastrar Evento</h3>
                                            <label>Data</label>
                                            <input type="date" required>
                                            <label>Hora</label>
                                            <input type="time" required>
                                            <label>Nome</label>
                                            <input type="text" required>
                                            <label>Local</label>
                                            <input type="text" required>
                                            <ul class="list-inline pull-right">
												<li><button type="button" class="btn btn-default prev-step">Voltar</button></li>
                                                <li><button type="button" class="btn btn-primary next-step">Salve e Continue</button></li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane" role="tabpanel" id="step3">
                                            <h3>Visualizar</h3>
                                            <p>This is step 3</p>
                                            <ul class="list-inline pull-right">
                                                <li><button type="button" class="btn btn-default prev-step">Voltar</button></li>
                                                <li><button type="button" class="btn btn-default next-step">Sair</button></li>
                                                <li><button type="button" class="btn btn-primary btn-info-full next-step">Salve e Continue</button></li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane" role="tabpanel" id="complete">
                                            <h3>Completo</h3>
                                            <p>You have successfully completed all steps.</p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </form>
                            </div>
                        </section>
                    </div>
                </div>
                <script language="JavaScript" type="text/javascript">

    $(document).ready(function () {
        //Initialize tooltips
        $('.nav-tabs > li a[title]').tooltip();

        //Wizard
        $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

            var $target = $(e.target);

            if ($target.parent().hasClass('disabled')) {
                return false;
            }
        });

        $(".next-step").click(function (e) {

            var $active = $('.wizard .nav-tabs li.active');
            $active.next().removeClass('disabled');
            nextTab($active);

        });
        $(".prev-step").click(function (e) {

            var $active = $('.wizard .nav-tabs li.active');
            prevTab($active);

        });
    });

                    function nextTab(elem) {
                        $(elem).next().find('a[data-toggle="tab"]').click();
                    }
                    function prevTab(elem) {
                        $(elem).prev().find('a[data-toggle="tab"]').click();
                    }
                </script>
            </div>
        </div>


    </div>

</div>
<?php
include("rest.php");