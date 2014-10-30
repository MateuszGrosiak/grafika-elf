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
                    Edytuj grupę
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <?php echo $this->Form->create('Group', array('role' => 'form')); ?>
                            <div class="form-group">
                                <?php echo $this->Form->input('id') ?>
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


<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Group.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Group.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Groups'), array('action' => 'index')); ?></li>
	</ul>
</div>
