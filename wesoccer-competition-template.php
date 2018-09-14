<?php

/* Template Name: Text Only Content */
get_header();
require_once('Competition.php');

?>

<?php
$competition = new Competition($_GET['id']);
?>

<div>
    <a href='/wesoccer-competition/?id=59'>SWFL 1</a>
    <a href='/wesoccer-competition/?id=60'>SWFL 2</a>
</div>
<div id="competition--info">
    <?php if (is_array($competition->competition_info)):?>
    <ul>
        <li><?php echo $competition->competition_info['name']." ({$competition->competition_info['short_name']})" ?></li>
    </ul>
    <?php endif; ?>
</div>
<div id="competition--fixtures">
    <?php if (is_array($competition->fixtures)): ?>
    <ul>
        <?php foreach ($competition->fixtures AS $date => $group): ?>
        <li><h3><?php echo $date ?></h3></li>
            <?php foreach ($group AS $fixture): ?>
            <li>
                <?php echo "{$fixture['home_team_name']}
                            {$fixture['start_hour']}:{$fixture['start_minutes']} 
                            {$fixture['away_team_name']} 
                            Status: {$fixture['match_status']} Minutes passed: {$fixture['minutes']}"?>
            </li>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
</div>
<?php

get_footer();

?>