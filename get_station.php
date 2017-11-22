<?php


        $parameters = array(
            
        );

        $key = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjljZTlmNDViYzc4M2VkNDg4ZTBiNzE4OTg5NTgzMGY4OTk0OTBlNjg0OTY4OGU5YzQ3ZDU3MjM1MTcxMTU3ZGQyY2U2NzIzNDdmNGMyMjkwIn0.eyJhdWQiOiI1IiwianRpIjoiOWNlOWY0NWJjNzgzZWQ0ODhlMGI3MTg5ODk1ODMwZjg5OTQ5MGU2ODQ5Njg4ZTljNDdkNTcyMzUxNzExNTdkZDJjZTY3MjM0N2Y0YzIyOTAiLCJpYXQiOjE1MTEzNDI3MzcsIm5iZiI6MTUxMTM0MjczNywiZXhwIjoxNTQyODc4NzM3LCJzdWIiOiIxMDIzNyIsInNjb3BlcyI6W119.Dymol_0tDNrMtAtOo79yN__t1vL6tz02KzrpBHVAy3QP8IrOo722xEkeUqGmusYSvPsttXkkmzDI6owcK_q6G7sNoPDwYyZSqz4FY4LRoaqEurgXkhFUdQcr7GbnUaEwC5Rf3NiK5D27edVMCanja2IWiy1T8CkTjjIcIq4r9Qh57i1SsjCSGyWRtdHh1FpJ8Wevf0aBHxoCfSCdGZ1GhNhv-Sb7bojtxYEXrUCa_9ZAZEsLjeVPND85qWPl1PsJNECMNu6w0-pZ0imcYmV5kWQLT1vtIpoUhoZeu0eWjoSG1pgK1hLESb2U5vJntQj-CmmMntd_bkZlUK3_ljNztctm7oGthHlB9Mt132SeknNCxNTfcdq1Nj8yabE53IuY6gYYcamdr4QNzo8xEoIGUJufj86DLY4GARcCAEkWfAUmeHBzvChRweNII213cddR9ryX2Zud40K4tRN1oA01K0gMVXPnZDLLaCRVQNld4E5tDltbTz_kYOSDU1K9B2g_YPEIh9DcCcUYGxVdbgclkOZu115f9lBl37J--iWwze_T3Lqd39v8fLfD9DyjXRden-vGVBwJoXcbtKQJy73BdDshe2JH_3zVI_1WXSZqwbtzADJDYGJRKUwGUFQJLV0JfgG_nuRgPeiCOHXr9J9nInh1RmF1-bNEoG2ynYHEMVY"; //you have to add personal access token 

        $header = ["Accept:application/json", "Authorization:Bearer ".$key];

        $method = 'GET';

        $url = 'https://www.pay2all.in/api/bus/v1/getStations';


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $response = curl_exec($ch);
        echo $response;  //[JSON RESPONSE]


?>