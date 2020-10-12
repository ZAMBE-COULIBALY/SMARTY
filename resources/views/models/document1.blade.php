<html>
    <head>
        <style>
            /**
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
            @page {
                margin: 0cm 0cm;
            }

            /** Define now the real margins of every page in the PDF **/
            body {
                margin-top: 2cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 2cm;
                width: 22cm;
                height: 28cm;
            }

            /** Define the header rules **/
            header {
                position: fixed;
                top: 0.5cm;
                left: 0.5cm;
                right: 0cm;
                height: 2cm;
                width: 20cm;

                /** Extra personal styles **/

            }

            /** Define the footer rules **/
            footer {
                position: fixed;
                bottom: 0cm;
                left: 0cm;
                right: 0cm;
                height: 2.5cm;
            }
             /** Define the footer rules **/
            #signature {
                position: relative;
                bottom: 5cm;
                left: 0cm;
                right: 0cm;
                height: 3cm;
            }

            #main {
                position: fixed;
                top: 3cm;
                left: 0.5cm;
                width: 20cm;
                right: 0cm;
                height: 21cm;
                border: solid 1px;
                margin: 0;
            }
        </style>
    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
        <header>
            <table style=" width: 100%; height: 2cm;">
                <tbody>
                    <tr>
                        <td style="width: 4cm; height:2cm;"><img src={{ asset('dist/img/logo-violet-nsia.png') }}  width="100%" height="100%"/></td>
                        <td style="text-align:center; font-family: Arial, Helvetica, sans-serif ; font-size: 16;  width: 10cm; height=2cm;" colspan="2">
                            <h1><p ><strong>CONDITIONS PARTICULIERES</strong> <br> <strong style="font-size:20">NSIA SMARTY</strong> </p></h1>
                        </td>
                        <td style="text-align: center; width: 4cm; height:2cm;">
                            <img src={{ asset('dist/img/NSIA.png') }} width="80%" height="80%"/>
                        </td>
                    </tr>
                </tbody>
            </table>
        </header>
        <div id="signature">
            <img src={{ asset('dist/img/pieddepage25ans.png') }} width="100%" height="100%"/>
        </div>
        <div id="footer">
            <img src={{ asset('dist/img/pieddepage25ans.png') }} width="100%" height="100%"/>
        </div>

        <!-- Wrap the content of your PDF inside a main tag -->
        <div id="main">
            <table style="border: solid 2px;width: 100%;">
                <tbody style="border: solid 2px;  font-size:14px; font-family: Arial, Helvetica, sans-serif; border-collapse: collapse;">
                    <tr><td colspan="10"><b> RESERVE A NSIA ASSRANCES </b></td></tr>
                    <tr>
                        <td colspan="2">Numéro de police</td>
                        <td colspan="3"><b>____________________________________________________</b></td>
                        <td colspan="2">Numéro du client</td>
                        <td colspan="3"><b>____________________________________________________</b></td>
                    </tr>
                    <tr>
                        <td colspan="2">Nom du conseiller</td>
                        <td colspan="3"><b>____________________________________________________</b></td>
                        <td colspan="1">Code</td>
                        <td colspan="1">______________</td>
                        <td colspan="1">Revendeur</td>
                        <td colspan="2">_______________________________</td>
                    </tr>
                </tbody>

            </table>
            <table  style="  border-collapse: collapse; border: 1px solid black; font-size:10px; font-family: Arial, Helvetica, sans-serif;">
                <tr>
                    <td style="width: 5px; background-color:#cbcbcb; ">
                        Souscripteur
                    </td>
                    <td style="width: 15px;">

                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>
