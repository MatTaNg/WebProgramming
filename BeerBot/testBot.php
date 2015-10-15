<HTML>
<HEAD>
<TITLE>Calling SWI-Prolog from PHP</TITLE>
</HEAD>

<BODY>

[ <A HREF="/index.html">Jocelyn Ireson-Paine's Home Page</A>
| <A HREF="/dobbs/prolog_from_php.html">How to Call SWI-Prolog from
PHP</A>
]

<CENTER>
<H1>Calling SWI-Prolog from PHP</H1>
</CENTER>

<? 
 // $cmd = "nice -n15 /software/bin/pl -f /home/popx/cgi-bin/test.pl -g test,halt";
  $cmd = "nice -n15 "./logic_cgi.prolog" -f C:\xampp\htdocs\BeerBot.pl -g test,halt";

?>

<P>
<TABLE BORDER>
<TR>
<TH ALIGN=left>
<PRE>
  system( $cmd );
</PRE>
</TH>
<TD ALIGN=left>
<PRE>
<? 
  system( $cmd );
?> 
</PRE>
</TD>
</TR>
<TR>
<TH ALIGN=left>
<PRE>
  $output = exec( $cmd );
  echo output;
</PRE>
</TH>
<TD ALIGN=left>
<PRE>
<? 
  $output = exec( $cmd );
  echo output;
?> 
</PRE>
</TD>
</TR>
<TR>
<TH ALIGN=left>
<PRE>
  exec( $cmd, $output );
  print_r( $output );
</PRE>
</TH>
<TD ALIGN=left>
<PRE>
<? 
  exec( $cmd, $output );
  print_r( $output );
?> 
</PRE>
</TD>
</TR>
<TR>
<TH ALIGN=left>
<PRE>
  $output = shell_exec( $cmd );
  echo $output;
</PRE>
</TH>
<TD ALIGN=left>
<PRE>
<? 
  $output = shell_exec( $cmd );
  echo $output;
?> 
</PRE>
</TD>
</TR>
</TABLE>
</P>

</BODY>
</HTML>