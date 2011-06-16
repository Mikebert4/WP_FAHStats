<?php
/*
Plugin Name: Folding at Home Stats
Plugin URI: http://slobros.com/2011/wp/plugins/folding-at-home-stats/
Description: This plugin displays your personal <a href="http://folding.stanford.edu/">Folding at Home</a> stats on your sidebar for everyone to see.  It shows the following stats:  your team name, user name, total folding packages completed, your overall user score, and your team score.
Version: 1.0
Author: SloBros
Author URI: http://slobros.com/
License: GPL2

Copyright 2011  SloBros  (email : rjkoehl@gmail.com)

*/

add_action('wp_print_styles', 'add_fold_stylesheet');

    function add_fold_stylesheet() {
        $myStyleUrl = WP_PLUGIN_URL . '/fah-stats/foldstyle.css';
		$myStyleFile = WP_PLUGIN_DIR . '/fah-stats/foldstyle.css';
        if ( file_exists($myStyleFile) ) {
            wp_register_style('foldStyleSheets', $myStyleUrl);
            wp_enqueue_style( 'foldStyleSheets');
        }
    }

register_activation_hook( __FILE__, 'fah_activate_stats' );

function fah_activate_stats() {
	//add values after plugin activates
	//values displayed on widget
		add_option('fold_urank','0');
		add_option('fold_wu','0');
		add_option('fold_upoints','0');
	
	//behind the scenes values
		add_option('fold_lastupdate','8000');
		
	}
	
register_deactivation_hook( __FILE__, 'fah_deactivate_stats' );

function fah_deactivate_stats() {
	//delete values for uninstall
		delete_option('fold_urank');
		delete_option('fold_wu');
		delete_option('fold_upoints');
		delete_option('fold_lastupdate');

	}

//==============================START WIDGET===================================
class WP_Folding_Widget extends WP_Widget {
    /** constructor */
    function WP_Folding_Widget() {
        parent::WP_Widget(false, $name = 'Folding@Home');
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {
        extract( $args );
		  $teamid = $instance['teamid'];
		  $username = $instance['username'];
		  $teamname = $instance['teamname'];
		  $fold_design = $instance['fold_design'];

		  
		  //start meat of plugin
			//  $test = (time() - get_option('fold_lastupdate'));  //test for correct counter time
			//  echo $test; //counter test
			if (((time()) - get_option('fold_lastupdate')) >= 7200) { //7200 seconds to next update
			
				$url = 'http://folding.xcpus.com/Folding/FoldingUserDetail.aspx?teamID='.$teamid.'&userName='.$username;
	
				//fetch content from page
				$content = wp_remote_fopen($url);
				
				//set and parse
				$dom = new DOMDocument();
				@$dom->loadHTML($content);
				$xpath = new DOMXPath($dom);
				
				//value for User Rank
				$urank_result = $xpath->query('//html//table/tr[2]/td');
				$urank_node = $urank_result->item(0);
				$urank = $urank_node->nodeValue;
				update_option('fold_urank',$urank);
	
				//value for Work Units
				$wu_result = $xpath->query('//html//table/tr[5]/td');
				$wu_node = $wu_result->item(0);
				$wu = $wu_node->nodeValue;
				update_option('fold_wu',$wu);
		
				//value for User Points
				$upoints_result = $xpath->query('//html//table/tr[4]/td');
				$upoints_node = $upoints_result->item(0);
				$upoints = $upoints_node->nodeValue;
				update_option('fold_upoints',$upoints);

				//update timestamp
				$update_time = time();
				update_option('fold_lastupdate',$update_time);
				
			
			} //end meat of plugin
		  
        ?>
              <?php echo $before_widget; ?>
                  <?php echo $before_title . "Folding at Home" . $after_title; ?>
				  
						<table cellspacing='0' class="<?php echo $fold_design; ?>">

<thead>
<tr>
<th class="Corner">Folding@Home</th>
<th class="Odd"><a href="http://fah-web.stanford.edu/cgi-bin/main.py?qtype=userpage&username=<?php echo $username; ?>" rel="nofollow">Stats</a></th>

</tr>
</thead>

<tbody>
<tr>
<th>Donor</th>
<td class="Odd"><?php echo $username; ?></td>
</tr>

<tr>
<th>Team</th>
<td class="Odd"><?php echo $teamname; ?></td>
</tr>

<tr>
<th>Work Units</th>
<td class="Odd"><?php echo get_option('fold_wu'); ?></td>
</tr>

<tr>
<th>Total Points</th>
<td class="Odd"><?php echo get_option('fold_upoints'); ?></td>
</tr>

<tr>
<th>Overall Rank</th>
<td class="Odd"><?php echo get_option('fold_urank'); ?></td>
</tr>

</tbody>
</table>
              <?php echo $after_widget; ?>
        <?php
	}

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {
	$instance = $old_instance;
	$instance['teamid'] = strip_tags($new_instance['teamid']);
	$instance['username'] = strip_tags($new_instance['username']);
	$instance['teamname'] = strip_tags($new_instance['teamname']);
	$instance['fold_design'] = strip_tags($new_instance['fold_design']);

	
	$reset_time = (get_option('fold_lastupdate') - 7200);  //7200 = to force update
	update_option('fold_lastupdate',$reset_time);

        return $instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {
		$teamid = esc_attr($instance['teamid']);
		$username = esc_attr($instance['username']);
		$teamname = esc_attr($instance['teamname']);
		$fold_design = esc_attr($instance['fold_design']);

        ?>
         <p>
		 <label for="<?php echo $this->get_field_id('teamid'); ?>"><?php _e('Team ID:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('teamid'); ?>" name="<?php echo $this->get_field_name('teamid'); ?>" type="text" value="<?php echo $teamid; ?>" />
		 </p>
		 <p>
		  <label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('User name:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" type="text" value="<?php echo $username; ?>" />
		</p>
		<p>
		  <label for="<?php echo $this->get_field_id('teamname'); ?>"><?php _e('Team name:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('teamname'); ?>" name="<?php echo $this->get_field_name('teamname'); ?>" type="text" value="<?php echo $teamname; ?>" />
		</p>
		<p>
					  <label for="<?php echo $this->get_field_id('fold_design'); ?>"><?php _e('Style:'); ?></label> 
			<select id="<?php echo $this->get_field_id('fold_design'); ?>" name="<?php echo $this->get_field_name('fold_design'); ?>" class="widefat" style="width:100%;">
    <option <?php selected( $instance['fold_design'], 'Design1'); ?> value="Design1">Design 1</option>
    <option <?php selected( $instance['fold_design'], 'Design2'); ?> value="Design2">Design 2</option> 
    <option <?php selected( $instance['fold_design'], 'Design3'); ?> value="Design3">Design 3</option> 
    <option <?php selected( $instance['fold_design'], 'Design4'); ?> value="Design4">Design 4</option>
    <option <?php selected( $instance['fold_design'], 'Design5'); ?> value="Design5">Design 5</option> 
    <option <?php selected( $instance['fold_design'], 'Design6'); ?> value="Design6">Design 6</option>
	<option <?php selected( $instance['fold_design'], 'Design7'); ?> value="Design7">Design 7</option>
			</select>
		</p>
		
		<p>
		Is <a href="http://folding.xcpus.com/Folding/FoldingUserDetail.aspx?teamID=<?php echo $teamid; ?>&userName=<?php echo $username; ?>">this</a> your stats profile? <br>
		If not, check your settings.
		</p>
        <?php 
    }

} 

// register WP_Folding_Widget widget
add_action('widgets_init', create_function('', 'return register_widget("WP_Folding_Widget");'));

?>