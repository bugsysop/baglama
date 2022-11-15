#!/bin/bash
# baglama.sh - Version 0.1
# Dependencie: WP-CLI
# Make executable: chmod u+x baglama.sh
# Help: ./baglama.sh -h

Dev()
{
  wp plugin install add-admin-css create-block-theme better-search-replace query-monitor code-snippets --activate
}
Help()
{
   echo
   echo "Install plugins for the current WordPress site:"
   echo
   echo "   1)   Developpement"
   echo "   2)   Permanent utilities"
   echo "   3)   Maintenance"
   echo
   echo "Options:"
   echo "   d     Install developpement plugins"
   echo "   h     Print this Help"
   echo "   m     Political statement"
   echo "   p     Install permanent usefull plugins"
   echo "   v     Current version of the script"
   echo "   u     Install utilities plugins"
   echo
   echo "Syntax:  baglama.sh [-d|h|m|p|u|v]"
   echo "Example: ./baglama.sh -p"
   echo
}
Mascot()
{
   echo
   echo '  Follow the white Rabbit'
   echo
   echo '  (\(\   '
   echo '  ( – -) '
   echo '  ((‘)(’)'
   echo
}
Permanent()
{
  wp plugin install block-manager enable-media-replace
}
Utilities()
{
  wp plugin install find-my-blocks regenerate-thumbnails-advanced wp-sweep
}
Version()
{
   echo
   echo "You are running version 0.1 (2022)"
   echo
}
# Get the options
while getopts ":dhmpuv" option; do
   case $option in
      d) # Plugins (developpement)
        Dev
        exit;;
      h) # Display Help
         Help
         exit;;
      m) # Statement
         Mascot
         exit;;
      p) # Plugins (permanent)
         Permanent
         exit;;        
      u) # Plugins (utilities)
         Utilities
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
