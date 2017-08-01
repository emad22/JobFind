<div class="users form">
  <?php echo $this->Session->Flash('auth'); ?>
  <?php echo $this->Form->create('User'); ?>
    <fieldset>
      <legend>
        <?php echo __('Please enter Your Username and Password'); ?>
      </legend>
      <?php echo $this->Form->input('username'); ?>
      <?php echo $this->Form->input('password'); ?>
    </fieldset>
    <?php echo $this->Form->end(__('Login')); ?>
