<?php

/**
 * @param $customerName STRING
 * @param $invoiceDate STRING
 * @param $address STRING
 * @param $invoicNo STRING
 * @param $clientPhone STRING
 * @param $clientEmail STRING
 * @param $serviceDetails STRING
 * @param $workName STRING
 * @param $workerAddress STRING
 * @param $workMobile STRING
 * @param $startingDate STRING
 * @param $serverChange STRING
 * @param $subTotal STRING
 * @param $serviveTax STRING
 * @param $cemDiscount STRING
 * @param $toBePaid integer
 * @param $pending integer
 * @param $total integer
 * @param $couponNo STRING
 */
function getBillFun($customerName, $invoiceDate, $address, $invoicNo, $clientPhone, $clientEmail,
                    $serviceDetails, $workName, $workerAddress, $workMobile, $startingDate, $serverChange,
                    $subTotal, $serviveTax, $cemDiscount, $toBePaid, $pending, $total, $couponNo){

    $format = "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.0 Transitional//EN'>
<HTML>
<HEAD>
    <META HTTP-EQUIV='CONTENT-TYPE' CONTENT='text/html; charset=us-ascii'>
    <TITLE></TITLE>
    <META NAME='GENERATOR' CONTENT='OpenOffice 4.1.1  (FreeBSD/amd64)'>
    <META NAME='CREATED' CONTENT='20160216;6573900'>
    <META NAME='CHANGED' CONTENT='0;0'>
    <STYLE TYPE='text/css'>
        <!--
        @page { margin: 0.5in }
        P { margin-bottom: 0.1in; direction: ltr; color: #000000; line-height: 120%; widows: 2; orphans: 2 }
        P.western { font-family: 'Arial', sans-serif; font-size: 10pt; so-language: en-US }
        P.cjk { font-family: 'Arial', sans-serif; font-size: 10pt }
        P.ctl { font-family: 'Arial', sans-serif; font-size: 10pt; so-language: ar-SA }
        TD P { margin-bottom: 0in; direction: ltr; color: #000000; widows: 2; orphans: 2 }
        TD P.western { font-family: 'Arial', sans-serif; font-size: 10pt; so-language: en-US }
        TD P.cjk { font-family: 'Arial', sans-serif; font-size: 10pt }
        TD P.ctl { font-family: 'Arial', sans-serif; font-size: 10pt; so-language: ar-SA }
        A:link { so-language: zxx }
        -->
    </STYLE>
</HEAD>
<BODY LANG='en-IN' TEXT='#000000' DIR='LTR'>
<TABLE WIDTH=735 BORDER=1 BORDERCOLOR='#ffffff' CELLPADDING=7 CELLSPACING=0 STYLE='page-break-before: always'>
    <COL WIDTH=360>
    <COL WIDTH=344>
    <TR VALIGN=TOP>
        <TD WIDTH=360>
            <P LANG='en-US' CLASS='western'><IMG SRC='../images/0751950001455634707_deepali_soni_html_160f19bd.png' NAME='Image1' ALIGN=LEFT WIDTH=133 HEIGHT=109 BORDER=0><BR>
            </P>
        </TD>
        <TD WIDTH=344>
            <P LANG='en-US' CLASS='western' ALIGN=RIGHT STYLE='margin-bottom: 0in'>
                #815, Main Huda Market,<BR>sector 31, Gurgaon - 122002</P>
            <P LANG='en-US' CLASS='western' ALIGN=RIGHT STYLE='margin-bottom: 0in'>
                (91) <A HREF='http://blueteam.in/'><I>95990 75355</I></A>
            </P>
            <P LANG='en-US' CLASS='western' ALIGN=RIGHT STYLE='margin-bottom: 0in'>
                info@blueteam.in
            </P>
            <P LANG='en-US' CLASS='western' ALIGN=RIGHT STYLE='margin-bottom: 0in'>
                www.blueteam.in</P>
            <P LANG='en-US' CLASS='western'><BR>
            </P>
        </TD>
    </TR>
</TABLE>
<P LANG='en-US' CLASS='western' STYLE='margin-bottom: 0in; line-height: 100%'>
    <BR>
</P>
<TABLE WIDTH=729 BORDER=1 BORDERCOLOR='#c0c0c0' CELLPADDING=4 CELLSPACING=0>
    <COL WIDTH=173>
    <COL WIDTH=174>
    <COL WIDTH=174>
    <COL WIDTH=174>
    <TR VALIGN=BOTTOM>
        <TD WIDTH=173>
            <P LANG='en-US' CLASS='western'><B>Customer Name:</B></P>
        </TD>
        <TD WIDTH=174>
            <P LANG='en-US' CLASS='western'>$customerName</P>
        </TD>
        <TD WIDTH=174>
            <P LANG='en-US' CLASS='western'><B>Invoice Date:</B></P>
        </TD>
        <TD WIDTH=174>
            <P LANG='en-US' CLASS='western'>$invoiceDate</P>
        </TD>
    </TR>
    <TR VALIGN=BOTTOM>
        <TD WIDTH=173>
            <P LANG='en-US' CLASS='western'><B>Street Address:</B></P>
        </TD>
        <TD WIDTH=174>
            <P LANG='en-US' CLASS='western'>$address</P>
        </TD>
        <TD WIDTH=174>
            <P LANG='en-US' CLASS='western'><B>Invoice Number</B></P>
        </TD>
        <TD WIDTH=174>
            <P LANG='en-US' CLASS='western'>$invoicNo</P>
        </TD>
    </TR>
    <TR VALIGN=BOTTOM>
        <TD WIDTH=173>
            <P LANG='en-US' CLASS='western'><B>City/Prov/Postal:</B></P>
        </TD>
        <TD WIDTH=174>
            <P LANG='en-US' CLASS='western'></P>
        </TD>
        <TD WIDTH=174>
            <P LANG='en-US' CLASS='western' STYLE='font-weight: normal'>Gurgaon</P>
        </TD>
        <TD WIDTH=174>
            <P LANG='en-US' CLASS='western'><BR>
            </P>
        </TD>
    </TR>
    <TR VALIGN=BOTTOM>
        <TD WIDTH=173>
            <P LANG='en-US' CLASS='western'><B>Home Phone:</B></P>
        </TD>
        <TD WIDTH=174>
            <P LANG='en-US' CLASS='western'>$clientPhone</P>
        </TD>
        <TD WIDTH=174>
            <P LANG='en-US' CLASS='western'><BR>
            </P>
        </TD>
        <TD WIDTH=174>
            <P LANG='en-US' CLASS='western'><BR>
            </P>
        </TD>
    </TR>
    <TR VALIGN=BOTTOM>
        <TD WIDTH=173>
            <P LANG='en-US' CLASS='western'><B>Email Address:</B></P>
        </TD>
        <TD WIDTH=174>
            <P LANG='en-US' CLASS='western'>$clientEmail<BR>
            </P>
        </TD>
        <TD WIDTH=174>
            <P LANG='en-US' CLASS='western'><BR>
            </P>
        </TD>
        <TD WIDTH=174>
            <P LANG='en-US' CLASS='western'><BR>
            </P>
        </TD>
    </TR>
</TABLE>
<P LANG='en-US' CLASS='western' STYLE='margin-bottom: 0in; line-height: 100%'>
    <BR>
</P>
<TABLE WIDTH=729 BORDER=1 BORDERCOLOR='#c0c0c0' CELLPADDING=4 CELLSPACING=0>
    <COL WIDTH=719>
    <TR>
        <TD WIDTH=719 VALIGN=BOTTOM>
            <P LANG='en-US' CLASS='western' STYLE='margin-bottom: 0in'><B>Hired:</B><B>
                $serviceDetails</B><SPAN STYLE='font-weight: normal'><BR>Name:  </SPAN><SPAN STYLE='font-weight: normal'>$workName</SPAN></P>
            <P LANG='en-US' CLASS='western' STYLE='margin-bottom: 0in'>Address:
                $workerAddress</P>
            <P LANG='en-US' CLASS='western' STYLE='margin-bottom: 0in'>Contact
                No: $workMobile</P>
            <P LANG='en-US' CLASS='western'>Start Date: $startingDate</P>
        </TD>
    </TR>
</TABLE>
<P LANG='en-US' CLASS='western' STYLE='margin-bottom: 0in; line-height: 100%'>
    <BR>
</P>
<TABLE WIDTH=728 BORDER=1 BORDERCOLOR='#c0c0c0' CELLPADDING=4 CELLSPACING=0>
    <COL WIDTH=609>
    <COL WIDTH=101>
    <TR VALIGN=TOP>
        <TD WIDTH=609 BGCOLOR='#92cddc'>
            <P LANG='en-US' CLASS='western'><B>WORK DESCRIPTION</B></P>
        </TD>
        <TD WIDTH=101 BGCOLOR='#92cddc'>
            <P LANG='en-US' CLASS='western'><B>AMOUNT</B></P>
        </TD>
    </TR>
    <TR VALIGN=TOP>
        <TD WIDTH=609>
            <P LANG='en-US' CLASS='western'>Service Charge</P>
        </TD>
        <TD WIDTH=101>
            <P LANG='en-US' CLASS='western'>$serverChange Rs</P>
        </TD>
    </TR>
    <TR VALIGN=TOP>
        <TD WIDTH=609>
            <P LANG='en-US' CLASS='western'><BR>
            </P>
        </TD>
        <TD WIDTH=101>
            <P LANG='en-US' CLASS='western'><BR>
            </P>
        </TD>
    </TR>
    <TR VALIGN=TOP>
        <TD WIDTH=609>
            <P LANG='en-US' CLASS='western'>Service Tax ( 14.5 % )</P>
        </TD>
        <TD WIDTH=101>
            <P LANG='en-US' CLASS='western'>$serviveTax Rs</P>
        </TD>
    </TR>
    <TR VALIGN=TOP>
        <TD WIDTH=609>
            <P LANG='en-US' CLASS='western' ALIGN=RIGHT>Sub Total</P>
        </TD>
        <TD WIDTH=101>
            <P LANG='en-US' CLASS='western'>$subTotal Rs</P>
        </TD>
    </TR>
    <TR VALIGN=TOP>
        <TD WIDTH=609>
            <P LANG='en-US' CLASS='western' ALIGN=LEFT><BR>
            </P>
        </TD>
        <TD WIDTH=101>
            <P LANG='en-US' CLASS='western'><BR>
            </P>
        </TD>
    </TR>
    <TR VALIGN=TOP>
        <TD WIDTH=609>
            <P LANG='en-US' CLASS='western' ALIGN=LEFT><B>CEM Discount ( 10% )</B></P>
        </TD>
        <TD WIDTH=101>
            <P LANG='en-US' CLASS='western'><B>$cemDiscount Rs</B></P>
        </TD>
    </TR>
    <TR VALIGN=TOP>
        <TD WIDTH=609>
            <P LANG='en-US' CLASS='western' ALIGN=RIGHT><B>To Be Paid ( 20 % )</B></P>
        </TD>
        <TD WIDTH=101>
            <P LANG='en-US' CLASS='western'>$toBePaid Rs</P>
        </TD>
    </TR>
    <TR VALIGN=TOP>
        <TD WIDTH=609>
            <P LANG='en-US' CLASS='western' ALIGN=RIGHT><B>Pending ( 80 % ) </B>
            </P>
        </TD>
        <TD WIDTH=101>
            <P LANG='en-US' CLASS='western'>$pending Rs</P>
        </TD>
    </TR>
    <TR VALIGN=TOP>
        <TD WIDTH=609>
            <P LANG='en-US' CLASS='western' ALIGN=RIGHT><BR>
            </P>
        </TD>
        <TD WIDTH=101>
            <P LANG='en-US' CLASS='western'><BR>
            </P>
        </TD>
    </TR>
    <TR VALIGN=TOP>
        <TD WIDTH=609>
            <P LANG='en-US' CLASS='western' ALIGN=RIGHT><B>Total </B>
            </P>
        </TD>
        <TD WIDTH=101 BGCOLOR='#92cddc'>
            <P LANG='en-US' CLASS='western'><B>$total</B> Rs</P>
        </TD>
    </TR>
</TABLE>
<P LANG='en-US' CLASS='western' STYLE='margin-bottom: 0in; line-height: 100%'>
    <BR>
</P>
<TABLE WIDTH=735 BORDER=1 BORDERCOLOR='#c0c0c0' CELLPADDING=7 CELLSPACING=0>
    <COL WIDTH=603>
    <COL WIDTH=102>
    <TR VALIGN=TOP>
        <TD WIDTH=603>
            <P LANG='en-US' CLASS='western' STYLE='margin-bottom: 0in'>Pay
                Total due in 3 days if person got hired. Overdue accounts subject
                to a service charge of 2% per month.</P>
            <P LANG='en-US' CLASS='western' STYLE='margin-bottom: 0in'><BR>
            </P>
            <P LANG='en-US' CLASS='western' STYLE='margin-bottom: 0in'><BR>
            </P>
            <P LANG='en-US' CLASS='western'>Customer Approval Signature:
                _______________________________________</P>
        </TD>
        <TD WIDTH=102>
            <P LANG='en-US' CLASS='western'>Thank you for your business!</P>
        </TD>
    </TR>
</TABLE>
<P CLASS='western' STYLE='margin-bottom: 0in; line-height: 100%'><BR>
</P>

<P CLASS='western' STYLE='margin-bottom: 0in; line-height: 100%'><BR>
</P>
<TABLE WIDTH=100% BORDER=1 BORDERCOLOR='#000000' CELLPADDING=4 CELLSPACING=0>
    <COL WIDTH=128*>
    <COL WIDTH=128*>
    <TR VALIGN=TOP>
        <TD WIDTH=50%>
            <P LANG='en-US' CLASS='western' ALIGN=CENTER><B>Reference Coupon |
                    Your Coupon</B></P>
        </TD>
        <TD WIDTH=50%>
            <P LANG='en-US' CLASS='western' ALIGN=CENTER><B>Reference Coupon |
                    Friend or Family Coupon</B></P>
        </TD>
    </TR>
    <TR VALIGN=TOP>
        <TD WIDTH=50%>
            <P LANG='en-US' CLASS='western' ALIGN=CENTER>2 Hour of on demand
                service</P>
        </TD>
        <TD WIDTH=50%>
            <P LANG='en-US' CLASS='western' ALIGN=CENTER>2 Hour of on demand
                service</P>
        </TD>
    </TR>
    <TR VALIGN=TOP>
        <TD WIDTH=50%>
            <P LANG='en-US' CLASS='western' ALIGN=CENTER><I>Coupon No. : $couponNo</I></P>
        </TD>
        <TD WIDTH=50%>
            <P LANG='en-US' CLASS='western' ALIGN=CENTER><I>Coupon No. : $couponNo</I></P>
        </TD>
    </TR>
    <TR VALIGN=TOP>
        <TD WIDTH=50%>
            <P LANG='en-US' CLASS='western' ALIGN=CENTER><A HREF='http://www.Blueteam.in/'>www.Blueteam.in</A>
                | 95990 75355</P>
        </TD>
        <TD WIDTH=50%>
            <P LANG='en-US' CLASS='western' ALIGN=CENTER><A HREF='http://www.Blueteam.in/'>www.Blueteam.in</A>
                | 95990 75355</P>
        </TD>
    </TR>
</TABLE>
<br/>
<P CLASS='western' ALIGN=RIGHT STYLE='margin-right: -0.39in; margin-bottom: 0in; line-height: 100%; text-decoration: none'>
    <FONT COLOR='#c0504d'><SPAN STYLE='background: transparent'>  <FONT FACE='Arial, sans-serif'><FONT SIZE=3><I><FONT SIZE=2 STYLE='font-size: 11pt'><SPAN STYLE='font-weight: normal'>A
product of </SPAN></FONT><FONT SIZE=4><SPAN STYLE='font-weight: normal'>
</SPAN></FONT><B><FONT SIZE=4>Shatkon Labs Pvt. Ltd.     </FONT></B></SPAN></I></FONT></FONT></FONT>
</P>
<P CLASS='western' ALIGN=CENTER STYLE='margin-bottom: 0in; font-style: normal; line-height: 100%; text-decoration: none'>
    <BR>
</P>
<P CLASS='western' ALIGN=CENTER STYLE='margin-bottom: 0in; font-style: normal; line-height: 100%; text-decoration: none'><A NAME='docs-internal-guid-6bd0d196-48e5-5b8d-2731-e1412cf2cb56'></A>
    <FONT FACE='Arial'><FONT SIZE=3 STYLE='font-size: 11pt'><B><SPAN STYLE='background: transparent'>TERMS
AND CONDITIONS</SPAN></B></FONT></FONT></P>

<P CLASS='western' ALIGN=JUSTIFY STYLE='font-style: normal; font-weight: normal; text-decoration: none'><A NAME='docs-internal-guid-6bd0d196-48e3-f488-2361-1c033283fa10'></A>
    <FONT FACE='Times New Roman, serif'><FONT SIZE=2><SPAN STYLE='background: transparent'><B>1)</B>
BlueTeam.in charges a fees for it&rsquo;s placement services which is
equivalent to the salary payable to the placed individual for his/her
services for a period of one month. Taxes as may be applicable shall
be payable separately by the user. </SPAN></FONT></FONT>
</P>
<P LANG='en-US' CLASS='western' ALIGN=JUSTIFY STYLE='margin-bottom: 0in; line-height: 138%'>
    <FONT FACE='Times New Roman, serif'><FONT SIZE=2><SPAN STYLE='text-decoration: none'><SPAN STYLE='font-style: normal'><B><SPAN STYLE='background: transparent'>2)</SPAN></B></SPAN></SPAN><SPAN STYLE='text-decoration: none'><SPAN STYLE='background: transparent'>
</SPAN></SPAN><SPAN STYLE='text-decoration: none'><SPAN STYLE='font-style: normal'><SPAN STYLE='font-weight: normal'><SPAN STYLE='background: transparent'>The
placed individual may be replaced by another individual of the user's
choice </SPAN></SPAN></SPAN></SPAN><SPAN STYLE='text-decoration: none'><SPAN STYLE='font-style: normal'><SPAN STYLE='font-weight: normal'><SPAN STYLE='background: transparent'>for</SPAN></SPAN></SPAN></SPAN><SPAN STYLE='text-decoration: none'><SPAN STYLE='font-style: normal'><SPAN STYLE='font-weight: normal'><SPAN STYLE='background: transparent'>
6 months with a maximum of 3 such replacements in a period of (X)
years/months. </SPAN></SPAN></SPAN></SPAN></FONT></FONT>
</P>
<P LANG='en-US' CLASS='western' ALIGN=JUSTIFY STYLE='margin-bottom: 0in; font-style: normal; font-weight: normal; line-height: 138%; text-decoration: none'>
    <FONT FACE='Times New Roman, serif'><FONT SIZE=2><SPAN STYLE='background: transparent'><B>3)</B>
A Renewal fees shall be payable after first six months, and the
quantum shall be equivalent to &nbsp;50% of the placed individual's
salary for period of next 6 months.</SPAN></FONT></FONT></P>
<P LANG='en-US' CLASS='western' ALIGN=JUSTIFY STYLE='margin-bottom: 0in; line-height: 138%'>
    <FONT FACE='Times New Roman, serif'><FONT SIZE=2><SPAN STYLE='text-decoration: none'><SPAN STYLE='font-style: normal'><B><SPAN STYLE='background: transparent'>4)</SPAN></B></SPAN></SPAN><SPAN STYLE='text-decoration: none'><SPAN STYLE='background: transparent'>
</SPAN></SPAN><SPAN STYLE='text-decoration: none'><SPAN STYLE='font-style: normal'><SPAN STYLE='font-weight: normal'><SPAN STYLE='background: transparent'>The
client undertakes to notify BlueTeam.in immediately upon agreeing to
hire a candidate introduced by BlueTeam.in</SPAN></SPAN></SPAN></SPAN></FONT></FONT></P>
<P LANG='en-US' CLASS='western' ALIGN=JUSTIFY STYLE='margin-bottom: 0in; line-height: 138%'>
    <FONT FACE='Times New Roman, serif'><FONT SIZE=2><SPAN STYLE='text-decoration: none'><SPAN STYLE='font-style: normal'><B><SPAN STYLE='background: transparent'>5)</SPAN></B></SPAN></SPAN><SPAN STYLE='text-decoration: none'><SPAN STYLE='background: transparent'>
</SPAN></SPAN><SPAN STYLE='text-decoration: none'><SPAN STYLE='font-style: normal'><SPAN STYLE='font-weight: normal'><SPAN STYLE='background: transparent'>An
invoice will be sent to the client upon commencement of employment
and the placement fee is payable immediately on the date of joining
of the candidate</SPAN></SPAN></SPAN></SPAN></FONT></FONT></P>
<P LANG='en-US' CLASS='western' ALIGN=JUSTIFY STYLE='margin-bottom: 0in; line-height: 138%'>
    <FONT FACE='Times New Roman, serif'><FONT SIZE=2><SPAN STYLE='text-decoration: none'><SPAN STYLE='font-style: normal'><B><SPAN STYLE='background: transparent'>6)</SPAN></B></SPAN></SPAN><SPAN STYLE='text-decoration: none'><SPAN STYLE='background: transparent'>
</SPAN></SPAN><SPAN STYLE='text-decoration: none'><SPAN STYLE='font-style: normal'><SPAN STYLE='font-weight: normal'><SPAN STYLE='background: transparent'>Introductions
are strictly confidential. If BlueTeam.in introduces a candidate that
the client then introduces to a third part, who hires the candidate
on either full time or part time, the client agrees to pay
BlueTeam.in the placement charges and taxes as applicable. </SPAN></SPAN></SPAN></SPAN></FONT></FONT>
</P>
<P LANG='en-US' CLASS='western' ALIGN=JUSTIFY STYLE='margin-bottom: 0in; line-height: 138%'>
    <FONT FACE='Times New Roman, serif'><FONT SIZE=2><SPAN STYLE='text-decoration: none'><SPAN STYLE='font-style: normal'><B><SPAN STYLE='background: transparent'>7)</SPAN></B></SPAN></SPAN><SPAN STYLE='text-decoration: none'><SPAN STYLE='background: transparent'>
</SPAN></SPAN><SPAN STYLE='text-decoration: none'><SPAN STYLE='font-style: normal'><SPAN STYLE='font-weight: normal'><SPAN STYLE='background: transparent'>While
it is the BlueTeam&rsquo;s endeavour to introduce the best suited
candidates to the client, it shall be the responsibility of the
client to satisfy themselves of the suitability of an applicant
before hiring them. If required the client may arrange for an
interview and medical examination of the candidate prior to hiring
them. BlueTeam.in shall assist as far as practicable to facilitate
the process. </SPAN></SPAN></SPAN></SPAN></FONT></FONT>
</P>
<P LANG='en-US' CLASS='western' ALIGN=JUSTIFY STYLE='margin-bottom: 0in; line-height: 138%'>
    <FONT FACE='Times New Roman, serif'><FONT SIZE=2><SPAN STYLE='text-decoration: none'><SPAN STYLE='font-style: normal'><B><SPAN STYLE='background: transparent'>8)</SPAN></B></SPAN></SPAN><SPAN STYLE='text-decoration: none'><SPAN STYLE='background: transparent'>
</SPAN></SPAN><SPAN STYLE='text-decoration: none'><SPAN STYLE='font-style: normal'><SPAN STYLE='font-weight: normal'><SPAN STYLE='background: transparent'>Prior
to the placement of the candidate the client shall share a job
description detailing the tasks which are expected to be performed by
the candidate upon placement. The client shall be bound by the said
description and shall not engage the placed individual in tasks which
fall outside the purview of those clearly stated in the job
description. BlueTeam shall not be liable for any conflict with
respect to tasks assigned which do not clearly fall within the scope
of the said description. The placed individual shall be at the
liberty to terminate the employment contract upon establishing that
tasks assigned to him/her fell squarely outside the scope of the
description. In such a case BlueTeam shall not be liable to provide
for a replacement &nbsp;and neither refund the placement charges paid
by the client. </SPAN></SPAN></SPAN></SPAN></FONT></FONT>
</P>
<P LANG='en-US' CLASS='western' ALIGN=JUSTIFY STYLE='margin-bottom: 0in; line-height: 138%'>
    <FONT FACE='Times New Roman, serif'><FONT SIZE=2><SPAN STYLE='text-decoration: none'><SPAN STYLE='font-style: normal'><B><SPAN STYLE='background: transparent'>9)</SPAN></B></SPAN></SPAN><SPAN STYLE='text-decoration: none'><SPAN STYLE='background: transparent'>
</SPAN></SPAN><SPAN STYLE='text-decoration: none'><SPAN STYLE='font-style: normal'><SPAN STYLE='font-weight: normal'><SPAN STYLE='background: transparent'>Despite
best efforts to ensure that the a thorough and deligent background
verification of the candidate/placed individual is perfomed, BlueTeam
strongly suggests that the client either himself or ask BlueTeam.in
to do a POLICE VERIFICATION of the worker. This ensures that the
worker is free of any criminal charges in the past. If BlueTeam.in is
asked to do a police verification, then it will chargeable as per
actuals.<br>
BlueTeam
shall not be responsible or liable for any act or omission, either
Civil or Criminal in nature, of the placed candidate. </SPAN></SPAN></SPAN></SPAN></FONT></FONT></P>

<P LANG='en-US' CLASS='western' ALIGN=JUSTIFY STYLE='margin-bottom: 0in; line-height: 138%'>
    <FONT FACE='Times New Roman, serif'><FONT SIZE=2><SPAN STYLE='text-decoration: none'><SPAN STYLE='font-style: normal'><B><SPAN STYLE='background: transparent'>10)</SPAN></B></SPAN></SPAN><SPAN STYLE='text-decoration: none'><SPAN STYLE='background: transparent'>
</SPAN></SPAN><SPAN STYLE='text-decoration: none'><SPAN STYLE='font-style: normal'><SPAN STYLE='font-weight: normal'><SPAN STYLE='background: transparent'>If
the invoices are settled and due to reason other than those mentioned
in Clause 8, &nbsp;the candidate resigns or otherwise fails to report
for work for a prolonged period without prior notice, &nbsp;a free
replacement shall be provided at no extra cost. Usually the time
taken for the replacement is 7 days but it may vary depending on the
availability.</SPAN></SPAN></SPAN></SPAN></FONT></FONT></P>
<P LANG='en-US' CLASS='western' ALIGN=JUSTIFY STYLE='margin-bottom: 0in; line-height: 138%'>
    <FONT FACE='Times New Roman, serif'><FONT SIZE=2><SPAN STYLE='text-decoration: none'><SPAN STYLE='font-style: normal'><B><SPAN STYLE='background: transparent'>11)</SPAN></B></SPAN></SPAN><SPAN STYLE='text-decoration: none'><SPAN STYLE='background: transparent'>
</SPAN></SPAN><SPAN STYLE='text-decoration: none'><SPAN STYLE='font-style: normal'><SPAN STYLE='font-weight: normal'><SPAN STYLE='background: transparent'>In
case where the placed individual has been hired part-time (Less than
24 hours) the client shall perform due diligence and perform a
checking of the objects carried by the placed individual while
entering and leaving the premises of the client. This is only for the
safety of the client. If the placed individual is found to carry
something objectionable, the client shall immediately notify
BlueTeam. </SPAN></SPAN></SPAN></SPAN></FONT></FONT>
</P>
<P LANG='en-US' CLASS='western' ALIGN=JUSTIFY STYLE='margin-bottom: 0in; line-height: 138%'>
    <FONT FACE='Times New Roman, serif'><FONT SIZE=2><SPAN STYLE='text-decoration: none'><SPAN STYLE='font-style: normal'><B><SPAN STYLE='background: transparent'>12)</SPAN></B></SPAN></SPAN><SPAN STYLE='text-decoration: none'><SPAN STYLE='background: transparent'>
</SPAN></SPAN><SPAN STYLE='text-decoration: none'><SPAN STYLE='font-style: normal'><SPAN STYLE='font-weight: normal'><SPAN STYLE='background: transparent'>The
client agrees that the worker shall not be subjected to harm, mental
or physical and shall be legally liable for such acts. If the placed
individual leaves due to any such reason, BlueTeam.in will not
replace the worker and neither refund the placement charges paid by
the client. </SPAN></SPAN></SPAN></SPAN></FONT></FONT>
</P>
<P LANG='en-US' CLASS='western' ALIGN=JUSTIFY STYLE='margin-bottom: 0in; line-height: 138%'>
    <FONT FACE='Times New Roman, serif'><FONT SIZE=2><SPAN STYLE='text-decoration: none'><SPAN STYLE='font-style: normal'><B><SPAN STYLE='background: transparent'>13)</SPAN></B></SPAN></SPAN><SPAN STYLE='text-decoration: none'><SPAN STYLE='background: transparent'>
</SPAN></SPAN><SPAN STYLE='text-decoration: none'><SPAN STYLE='font-style: normal'><SPAN STYLE='font-weight: normal'><SPAN STYLE='background: transparent'>All
payments shall to be made in favour of &lsquo;SHATKON LABS Pvt Ltd&rsquo;</SPAN></SPAN></SPAN></SPAN></FONT></FONT></P>
<P LANG='en-US' CLASS='western' ALIGN=JUSTIFY STYLE='margin-bottom: 0in; line-height: 138%'>
    <FONT FACE='Times New Roman, serif'><FONT SIZE=2><SPAN STYLE='text-decoration: none'><SPAN STYLE='font-style: normal'><B><SPAN STYLE='background: transparent'>14)</SPAN></B></SPAN></SPAN><SPAN STYLE='text-decoration: none'><SPAN STYLE='background: transparent'>
</SPAN></SPAN><SPAN STYLE='text-decoration: none'><SPAN STYLE='font-style: normal'><SPAN STYLE='font-weight: normal'><SPAN STYLE='background: transparent'>All
disputes shall be subject to Delhi Jurisdiction only. </SPAN></SPAN></SPAN></SPAN></FONT></FONT>
</P>
<P LANG='en-US' CLASS='western' ALIGN=JUSTIFY><FONT COLOR='#000000'><SPAN STYLE='text-decoration: none'><FONT FACE='Times New Roman, serif'><FONT SIZE=2><SPAN STYLE='font-style: normal'><B><SPAN STYLE='background: transparent'>15)</SPAN></B></SPAN></FONT></FONT></SPAN></FONT><FONT COLOR='#000000'><SPAN STYLE='text-decoration: none'><FONT FACE='Times New Roman, serif'><FONT SIZE=2><SPAN STYLE='background: transparent'>
</SPAN></FONT></FONT></SPAN></FONT><FONT COLOR='#000000'><SPAN STYLE='text-decoration: none'><FONT FACE='Times New Roman, serif'><FONT SIZE=2><SPAN STYLE='font-style: normal'><SPAN STYLE='font-weight: normal'><SPAN STYLE='background: transparent'>If
due to any circumstance where a refund becomes due to the client, the
amount shall be refunded within 90 days of the candidate leaving the
job.</SPAN></SPAN></SPAN></FONT></FONT></SPAN></FONT></P>

<P CLASS='western' STYLE='margin-bottom: 0in; line-height: 100%'>Customer
    Signature: _______________________________________</P>
<P CLASS='western' STYLE='margin-bottom: 0in; line-height: 100%'><BR>
</P>
</BODY>
</HTML>";

    //==============================================================
    //==============================================================
    //==============================================================

    include("../library/mpdf60/mpdf.php");
    $mpdf=new mPDF('c');

    $mpdf->WriteHTML($format);
    $mpdf->Output();
    exit;

    //==============================================================
    //==============================================================
    //==============================================================

}
?>