<?php
echo '<pre>';

// 输出 shell 命令 "ls" 的返回结果
// // 并且将输出的最后一样内容返回到 $last_line。
// // 将命令的返回值保存到 $retval。
 $last_line = system('ls', $retval);
//
// // 打印更多信息
 echo '
 pre>
 <hr />Last line of the output: ' . $last_line . '
 <hr />Return value: ' . $retval;
 ?>'
