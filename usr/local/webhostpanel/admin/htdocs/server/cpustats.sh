filename="/tmp/.cpstats"
top -n0 > $filename
term=`tty`
exec < $filename
i=0
while [ $i -le 4 ]
do
read line
set $line
case $i in
0)
uptime=`echo $4 | tr "," " "`
cpu1=`echo $9 | tr "," " "`
shift 9
cpu5=`echo $1 | tr "," " "`
cpu15=`echo $2 | tr "," " "`


echo uptime=$uptime
echo cpu 1 min = $cpu1
echo cpu 5 min = $cpu5
echo cpu 15 min= $cpu15
;;

3)
mem_total=`echo $2 | tr "K" " "`
mem_used=`echo $4 | tr "K" " "`
mem_free=`echo $6 | tr "K" " "`
mem_shared=`echo $8  | tr "K" " "`
shift 1
mem_buff=`echo $9 | tr "K" " "`
echo  $mem_total KB
echo $mem_used KB
echo $mem_free KB
echo $mem_shared KB
echo $mem_buff KB
;;

4)
swp_total=`echo $2 | tr "K" " "`
swp_used=`echo $4 | tr "K" " "`
swp_free=`echo $6 | tr "K" " "`
cache_mem=`echo $8  | tr "K" " "`
echo Total Swap= $swp_total KB
echo Swap Used= $swp_used KB
echo Swap Free= $swp_free KB
echo Cache memory= $cache_mem KB
;;
esac
i=`expr $i + 1`
done
i=0
exec < $term
echo -e "Filesystem\tTotal Size\tUsed\t\tAvailable\tCapacity\tMount Point"
df --type=ext3 -h > $filename
exec < $filename
while read line
do 
if [ $i -ne 0 ]
then
set $line
file_system=$1
total_siz=$2
used=$3
avail=$4
capacity=$5
mounted_on=$6

echo -e "$file_system\t$total_siz\t\t$used\t\t$avail\t\t$capacity\t\t$mounted_on"
fi
i=`expr $i + 1`
done
exec < $term
rm -f $filename
