#!/bin/bash
# baglama.sh - Version 0.2
# Dependencie: WP-CLI
# Make executable: chmod u+x baglama.sh
# Help: ./baglama.sh -h

Dev()
{
  wp plugin install add-admin-css create-block-theme better-search-replace query-monitor wp-crontrol
}
DevAct()
{
  wp plugin install add-admin-css create-block-theme better-search-replace query-monitor wp-crontrol --activate
}
Help()
{
   echo
   echo "Install plugins for the current WordPress site:"
   echo
   echo "- Developpement: essential plugins for coding and hacking."
   echo "- Permanent: useful plugins to add more functionalities to WordPress."
   echo "- Utilities: plugins to install temporary for maintenance tasks."
   echo
   echo "Plugins list: add-admin-css, create-block-theme, better-search-replace, query-monitor, wp-crontrol, block-manager, enable-media-replace, find-my-blocks, regenerate-thumbnails-advanced, wp-sweep, custom-post-type-cleanup"
   echo
   echo "Options:"
   echo "     d     Install developpement plugins"
   echo "     D     Install and activate developpement plugins"
   echo "     h     Print this Help"
   echo "     m     Political statement"
   echo "     p     Install permanent useful plugins"
   echo "     P     Install and activate useful plugins"
   echo "     v     Current version of the script"
   echo "     u     Install utilities plugins"
   echo "     U     Install and activate utilities plugins"
   echo
   echo "- Syntax:  baglama.sh [-d|D|h|m|p|P|u|U|v]"
   echo "- Example: ./baglama.sh -p"
   echo "- Example: ./baglama.sh -Dpu"
   echo
}
Mascot()
{
   echo
   echo '  Follow the White Rabbit'
   echo
   echo '  (\(\   '
   echo '  ( – -) '
   echo '  ((’)(’)'
   echo
}
Permanent()
{
  wp plugin install block-manager enable-media-replace
}
PermanentAct()
{
  wp plugin install block-manager enable-media-replace --activate
}
Utilities()
{
  wp plugin install find-my-blocks regenerate-thumbnails-advanced wp-sweep custom-post-type-cleanup
}
UtilitiesAct()
{
  wp plugin install find-my-blocks regenerate-thumbnails-advanced wp-sweep custom-post-type-cleanup --activate
}
Version()
{
   echo
   echo "You are running version 0.2 (2022)"
   echo "This code is placed in the Public Domaine"
   echo
}
# Get the options
while getopts ":dDhmpPuUv" option; do
   case $option in
      d) # Install (developpement)
        Dev
        exit;;
      D) # Install & activate (developpement)
         DevAct
         exit;;
      h) # Display Help
         Help
         exit;;
      m) # Statement
         Mascot
         exit;;
      p) # Install (permanent)
         Permanent
         exit;;
      P) # Install & activate (permanent)
         PermanentAct
         exit;;        
      u) # Install (utilities)
         Utilities
         exit;;
      U) # Install & activate (utilities)
         UtilitiesAct
         exit;;
      v) # Display Version
         Version
         exit;;
     \?) # Ooooops!
         echo
         echo "Fatal error: invalid option!"
         echo "Look at the Help (-h) don’t kill the white rabbit"
         echo
         exit;;
   esac
done
