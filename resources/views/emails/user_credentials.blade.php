<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Email Template</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Work+Sans&display=swap" rel="stylesheet" />
</head>

<body style="background: white; margin: 0px; padding-top: 30px;">
    <table class="center" align="center" style="border-color: #000; border: 0px; border-spacing: 0px">
        <tbody>
            <table class="center" style="
          background: white;
          width: 600px;
          padding: 30px 0px;
          margin: 0px auto;
          border-color: #000;
          border: 0px;
          border-spacing: 0px;
          box-shadow: 0 20px 0px 0px white, 0px 0px 16px #0000000F, 0px 0px 16px #0000000F, 0px 0px 16px #0000000F;
        ">
                <tr>
                    <th>
                        <img src="https://portal.mrm-soft.com/public/images/emailcredentials.png" alt="" title="" style="
                outline: none;
                text-decoration: none;
                -ms-interpolation-mode: bicubic;
                clear: both;
                display: inline-block !important;
                border: none;
                height: auto;
                float: none;
                width: 100%;
                max-width: 447px;
              " width="447" />
                    </th>
                </tr>
            </table>
            <table class="center" style="
          background: white;
          width: 600px;
          padding-left: 77px;
          margin: 0px auto;
          box-shadow: 0 20px 0px 0px white, 0 -20px 0px 0px white, 0px 0px 16px #0000000F, 0px 0px 16px #0000000F;
        ">
                 <tr>
                    <td>
                        <p style="
                color: black;
                font-family: 'Work Sans', sans-serif;
                font-size: 30px;
                text-align: left;
                margin: 0;
                width: 100%;
                height: 55px;
                line-height: 1.4;
              ">
                           Hi {{ucfirst($name)}},

                        </p>
                    </td>
                </tr>
                 <tr>
                    <td>
                        <p style="
                color: black;
                font-family: 'Work Sans', sans-serif;
                font-size: 20px;
                text-align: left;
                margin: 0;
                width: 100%;
                height: 55px;
                line-height: 1.4;
              ">
                            Welcome to MRM Portal!
                        </p>
                    </td>
                </tr>
            </table>
            <table class="center" style="
          background: white;
          width: 600px;
          margin: 0px auto;
          padding: 0px 77px;
          box-shadow: 0 20px 0px 0px white, 0 -20px 0px 0px white, 0px 0px 16px #0000000F, 0px 0px 16px #0000000F;
        ">
                <tr>
                    <td style="background: white">
                        <p style="
                margin: 0;
                line-height: 1.2;
                text-align: left;
                font-family: 'Work Sans';
                font-size: 14px;
              ">
                            We are all really excited to welcome you to our team! Please login with the given credentials, and change your password from your profile.
                            <br /><br /> Username: <strong>{{ $email  }}</strong> <br />Password:
                            <strong>{{ $plain_password  }}</strong>
                        </p>
                    </td>
                </tr>
            </table>
            <table class="center" style="
          width: 600px;
          margin: 0px auto;
          padding: 20px 77px;
          background-color: white;
          box-shadow: 0 20px 0px 0px white, 0 -20px 0px 0px white, 0px 0px 16px #0000000F, 0px 0px 16px #0000000F;
        ">
                <tr>
                    <td  style="background: white;">
                        <a target="_blank" href="https:/portal.mrm-soft.com">
                            <input style="
                            width: 100%;
                            background: #ff5d76;
                            border: 0px;
                            padding: 13px 0px;
                            box-shadow: 0px 3px 6px #00000029;
                            border-radius: 5px;
                            font-family: 'Work Sans';
                            font-size: 16px;
                            color: white;
                            cursor: pointer;
                          " type="button" value="Login to your dashboard" />
                         </a>
                    </td>
                </tr>
            </table>
      <table
        class="center"
        style="
          background: white;
          width: 600px;
          box-shadow:0px 0px 0px #0000000f, 0 -10px 0px 0px white, 0px 0px 16px #0000000f, 0px 0px 16px #0000000f;
          /* box-shadow: 0px 3px 6px #00000029; */
          margin: 0px auto;
          padding: 0px 77px;
        "
      >
        <tr>
          <td style="background: white;">
            <p
              style="
                margin: 0;
                line-height: 1.2;
                text-align: left;
                font-family: 'Work Sans';
                font-size: 14px;
              "
            >
              <span style="font-weight: 600">Daily Progress</span><br />It’s a
              useful tool for supervisors to track employees based on how much
              work they have done. On the other hand, employee can also check
              their tasks, since it allows them to see their own progress.<br /><br /><span
                style="font-weight: 600"
                >Attendance</span
              ><br />Please check daily attendance under the attendance section.
            </p>
          </td>
        </tr>
      </table>

      <table
        class="center"
        style="
          width: 600px;
          margin: 0px auto;
          border: 0px;
          padding: 90px 77px;
          border-color: #000;
          background-color: white;
          border-spacing: 0px;
        "
      >
        <tr>
          <td>
            <p
              style="
                margin: 0;
                line-height: 1.2;
                text-align: center;
                font-family: 'Work Sans';
                font-size: 10px;
              "
            >
              <span
                >© 2021 MRM-Portal. L-26 Block 16, Gulshan-e-Iqbal,
                Karachi</span
              ><br /><br />Disclaimer goes here: You received this message
              because you signed up to mrmportal. You received this message
              because you signed up to mrmportal, you received this message
              because you signed up to mrmportal. You received this message
              because you signed up to mrm-portal, you received this message
              because you signed up to mrmportal. You received this message
              because you signed up to mrm-portal, you received this message
              because you signed up to mrmportal.
            </p>
          </td>
        </tr>
      </table>
    </tbody>
    </table>
  </body>
</html>