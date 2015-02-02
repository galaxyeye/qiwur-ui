<?php global $school_keywords, $school_description; ?>

<div class="schools form">
<?php echo $this->Form->create('School', array('type' => 'file'));?>
	<fieldset>
 		<legend><?php __('Admin Add School'); ?></legend>
	<?php 
		echo $this->Form->input('name_en');
		echo $this->Form->input('type');
		// echo $this->Form->input('name_zh');
		echo $this->Form->input('image', array('type' => 'file'));
		echo $this->Form->input('address');
		echo $this->Form->input('website');
//		echo $this->Form->input('short_desc');
//		echo $this->Form->input('desc');
		echo $this->Form->input('area_id');
		echo $this->Form->input('district_id');
		echo $this->Form->input('latlng');

		echo $this->Form->input('meta_keywords', array('value' => $school_keywords));
		echo $this->Form->input('meta_description', array('value' => $school_description));
  ?>
	</fieldset>

	<?php echo $this->Form->end(__('Submit', true));?>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Schools', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Compounds', true), array('controller' => 'compounds', 'action' => 'index')); ?> </li>
	</ul>
</div>
