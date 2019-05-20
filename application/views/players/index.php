<h2><?php echo $title;?></h2>

<?php foreach($players as $v):?>
    <h3><?php echo $v['name'];?></h3>
    <div><?php echo $v['age'];?></div>
    <p><a href="<?php echo site_url('players/view/'.$v['Id']);?>">View player</a></p>
<?php endforeach;?>