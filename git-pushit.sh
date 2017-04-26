
git push origin
B0="chrome.exe"
B1="firefox.exe"
if [ "$B0" = "chrome.exe" ]; then
start "chrome.exe" https://www.youtube.com/watch?v=vCadcBR95oU
echo \'Real gooood $B0!\'
elif [ "$B1" = "firefox.exe" ]; then
start "firefox.exe" https://www.youtube.com/watch?v=vCadcBR95oU
echo \'Real gooood $B1!\'
else
echo \"De ti browser?! \"
fi


#Salt-N-Pepa - Push it, push it
#
#https://www.youtube.com/watch?v=vCadcBR95oU

#SCARFACE
#
#https://www.youtube.com/watch?v=9D-QD_HIfjA
#alias pushit="git push origin;  https://www.youtube.com/watch?v=vCadcBR95oU;"