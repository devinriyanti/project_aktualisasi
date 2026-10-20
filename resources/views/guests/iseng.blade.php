
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Website Anda Dinonaktifkan</title>

    <!-- Font Awesome untuk ikon profil dan WhatsApp -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 28px 20px;
            font-family: Arial, Helvetica, sans-serif;
            color: #ffffff;
            background:
                radial-gradient(
                    circle at top,
                    #203454 0%,
                    transparent 55%
                ),
                linear-gradient(
                    135deg,
                    #0b1020,
                    #111827 65%,
                    #080c16
                );
        }

        .container {
            width: 100%;
            max-width: 1150px;
            padding: 55px 38px;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 38px;
            background: linear-gradient(
                145deg,
                rgba(39, 56, 84, 0.96),
                rgba(23, 29, 43, 0.98)
            );
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.35);
            animation: muncul 0.8s ease;
        }

        /* Ikon profil */
        .contact-avatar {
            width: 125px;
            height: 125px;
            margin: 0 auto 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: linear-gradient(
                135deg,
                #3c567d,
                #172033
            );
            border: 2px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.25);
        }

        .contact-avatar i {
            font-size: 58px;
            color: #cbd5e1;
        }

        /* Badge status */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 12px 22px;
            margin-bottom: 34px;
            border-radius: 50px;
            background: rgba(239, 68, 68, 0.12);
            border: 1px solid rgba(248, 113, 113, 0.45);
            color: #fca5a5;
            font-size: 15px;
            font-weight: 800;
            letter-spacing: 1.3px;
        }

        /* Judul */
        h1 {
            font-size: clamp(32px, 5vw, 62px);
            line-height: 1.25;
            margin-bottom: 28px;
            font-weight: 800;
        }

        h1 .title-white {
            color: #ffffff;
        }

        h1 .title-red {
            color: #ff7272;
        }

        /* Deskripsi */
        .description {
            max-width: 760px;
            margin: 0 auto 38px;
            color: #b5c1d4;
            font-size: 18px;
            line-height: 1.9;
        }

        /* Pertanyaan */
        .question {
            font-size: clamp(24px, 3vw, 34px);
            font-weight: 800;
            margin-bottom: 20px;
        }

        .question span {
            color: #4ade80;
        }

        .contact-text {
            margin-bottom: 32px;
            color: #b5c1d4;
            font-size: 17px;
            line-height: 1.9;
        }

        /* Tombol WhatsApp */
        .whatsapp-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            padding: 20px 35px;
            background: #20c763;
            color: #052e16;
            font-size: 18px;
            font-weight: 800;
            text-decoration: none;
            border-radius: 16px;
            transition: all 0.25s ease;
            box-shadow: 0 10px 30px rgba(34, 197, 94, 0.18);
        }

        .whatsapp-button i {
            font-size: 26px;
        }

        .whatsapp-button:hover {
            background: #4ade80;
            transform: translateY(-4px);
            box-shadow: 0 14px 35px rgba(34, 197, 94, 0.28);
        }

        /* Footer */
        .footer {
            margin-top: 48px;
            padding-top: 28px;
            border-top: 1px solid rgba(255, 255, 255, 0.12);
            color: #718198;
            font-size: 14px;
            line-height: 1.8;
        }

        /* Animasi */
        @keyframes muncul {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Tampilan HP */
        @media (max-width: 600px) {
            body {
                padding: 15px;
            }

            .container {
                padding: 35px 20px;
                border-radius: 24px;
            }

            .contact-avatar {
                width: 100px;
                height: 100px;
                margin-bottom: 25px;
            }

            .contact-avatar i {
                font-size: 45px;
            }

            .badge {
                font-size: 11px;
                padding: 10px 15px;
                margin-bottom: 25px;
            }

            h1 {
                margin-bottom: 22px;
            }

            .description {
                font-size: 15px;
                margin-bottom: 30px;
            }

            .question {
                font-size: 24px;
            }

            .contact-text {
                font-size: 14px;
                margin-bottom: 25px;
            }

            .whatsapp-button {
                width: 100%;
                padding: 17px 15px;
                font-size: 15px;
                border-radius: 12px;
            }

            .whatsapp-button i {
                font-size: 22px;
            }

            .footer {
                margin-top: 35px;
                padding-top: 22px;
                font-size: 12px;
            }
        }
    </style>
</head>

<body>

    <main class="container">

        <!-- Ikon profil pengganti foto -->
        <div class="contact-avatar">
            <i class="fa-solid fa-user-tie"></i>
        </div>

        <!-- Status website -->
        <div class="badge">
            <i class="fa-solid fa-triangle-exclamation"></i>
            WEBSITE NONAKTIF
        </div>

        <!-- Judul utama -->
        <h1>
            <span class="title-white">Yahhhh 😭</span><br>
            <span class="title-red">
                Website Anda Dinonaktifkan!
            </span>
        </h1>

        <!-- Deskripsi -->
        <p class="description">
            Waduh, website kesayangan Anda sedang tidak aktif nih.
            Pengunjung jadi nggak bisa mampir dan melihat website Anda.
            Sayang banget, kan? 🥲
        </p>

        <!-- Ajakan -->
        <p class="question">
            Mau dihidupin lagi? <span>😎</span>
        </p>

        <p class="contact-text">
            Tenang, jangan panik dulu!<br>
            Hubungi Devina sekarang untuk mengaktifkan kembali
            website Anda.
        </p>

        <!-- Tombol WhatsApp Devina -->
        <a
            class="whatsapp-button"
            href="https://wa.me/6282237027230?text=Halo%20Devina%2C%20saya%20ingin%20mengaktifkan%20kembali%20website%20saya."
            target="_blank"
            rel="noopener noreferrer"
        >
            <i class="fa-brands fa-whatsapp"></i>
            Hubungi Devina via WhatsApp
        </a>

        <!-- Footer -->
        <footer class="footer">
            &copy; 2026 Website Anda · Butuh bantuan? Kami siap membantu.
        </footer>

    </main>

</body>
</html>
