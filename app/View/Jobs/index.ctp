<?php echo $this->element('search'); ?>
<br>
<h3>Latest Job Listings </h3>
<ul id="Listings">
  <?php foreach ($jobs as $job) :?>
    <li>
        <div class="type">
            <span style="background:<?php echo  $job['Type']['color']; ?>"><?php echo $job['Type']['name']; ?></span>
        </div>
        <div class="description">
            <h5><?php echo $job['Job']['title']; ?>  (  <?php echo $job['Job']['city'];?>,<?php echo $job['Job']['state']; ?>  )</h5>

            <span id="list_date">
              <?php echo $this->Time->format('F jS h:i A',$job['Job']['created']); ?>
            </span>

            <br>
            <?php echo $this->Text->truncate( $job['Job']['description'],150, array('ellipsis' =>'...','extact' =>false )); ?>
            <?php echo $this->Html->link('Read More', array('controller' =>'jobs' ,'action'=>'view' ,$job['Job']['id'] )); ?>
        </div>
    </li>
    <?php endforeach; ?>
</ul>
