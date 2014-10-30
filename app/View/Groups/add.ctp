<div id="page-wrapper">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Grupa studentów</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Dodaj grupę
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-4">
                        <?php echo $this->Form->create('Group', array('role' => 'form')); ?>
                            <div class="form-group">
                                <?php echo $this->Form->input('name', array('class' => 'form-control', 'label' => 'Nazwa')) ?>
                            </div>
                        <?php echo $this->Form->submit('Zapisz', array('class' => 'btn btn-success')) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>