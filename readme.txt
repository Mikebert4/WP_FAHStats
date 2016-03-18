#This is a fork of SloBros wordpress plugin
https://wordpress.org/plugins/folding-at-home-stats/developers/

=== Folding at Home Stats ===
Contributors: SloBros
Donate link: http://slobros.com/2011/wp/plugins/folding-at-home-stats/
Tags: folding at home, folding stats , fah
Requires at least: 2.5
Tested up to: 3.1.3
Stable tag: 1

== Description ==

= What is Folding at Home? =
Folding @ Home is a computer simulation of protein folding processed by your computer's CPU, GPU, or PS3.  Protein folding is the root cause of many health problems, and with the information gathered from running the simulations, scientists at Stanford University better understand why proteins misfold and how to fix them.  
This project is a noble cause and doesn't require any monetary contribution, just your free CPU cycles.  Your PC can provide for the advancement of everyone and possibly lead to the cure for some diseases.

Please join the cause and feel free to fold under our team, or create your own!  Get started at Standford's website, [Folding @ Home](http://folding.stanford.edu/).

= What does this plugin do? =
This plugin displays your personal [Folding@Home](http://folding.stanford.edu/) stats on your sidebar for everyone to see.  It shows the following stats:  your team name, user name, total folding packages completed, your overall user score, and your team score.

The stats are provided by the good people at [Xtreme CPU](http://www.xcpus.com/) and automatically updated every 2 hours.

== Installation ==

1. If you do not already have a Folding at Home team name and username, [go here](http://folding.stanford.edu/) to download the client and register.

2. Download the Folding at Home Stats plugin and upload the contents of the zip file to your "wp-content/plugins" directory.

3. Go to the Plugins menu and find "Folding at Home Stats", and click "Activate".

4. Go to the Widgets sub-menu under Appearance and find the "Folding@Home" widget.  Add it to your theme by dragging it to the right into the sidebar.

5. Insert your team ID and user name into the appropriate fields *both are required!* and click save.  Your stats will now be displayed on the front sidebar.

== Frequently Asked Questions ==

= I can't see my stats, what's wrong? =

Check that you have entered your team id and username correctly by clicking the, "Is this your stats profile?" link in the widget.  If you can't see your profile page, it's likely the team id and username are entered incorrectly.

= My team ID and username are both entered correctly, but I still don't see any stats. =

The Folding at Home Stats Plugin relies on [Xtreme CPU](http://folding.xcpus.com/Folding) to serve stats.  If their website is down or experiencing difficulties, this will have an effect on the stats appearing on your homepage.  Check their site to see if it's running smoothly.  The stats will return automatically once the site is running again.

= When do the stats update? =

Stats update every two hours.  The official stats from Stanford update every hour, and Xtreme CPU's stats update hourly as well.  The reason why we decided to make the stats update every 2 hours instead of 1 is out of consideration for the guys at Xtreme CPU.  Frequent updates can put a lot of stress on their servers they don't need.

= Why did you choose Xtreme CPU? =

Standford forbids people from taking stats off their pages.  Instead, they provide an hourly updated database file that is way too huge for us to handle.  Extreme Overclocking has a great stats database, but they limit the teams and users to only the top 6 or 8,000 contributors.  That's great for the veteran folder, but we wanted to attract new people to the Folding @ Home project.  Xtreme CPU holds stats records for all users, big and small, so that's why we wanted to go with them.  Plus, they're pretty cool!

== Screenshots ==

fah-stats-front.png

fah-stats-back.png

If these screenshots are unavailable, you can see them at the [plugin homepage](http://slobros.com/2011/wp/plugins/folding-at-home-stats/)

== Changelog ==

= 1.0 =
* This is the first version

== Upgrade Notice ==
Backup all files and the database before upgrading.
