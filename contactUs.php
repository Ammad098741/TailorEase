<?php 
    session_start();
    $currentPage = "contactUs";
    include "HeaderFile.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Contact Us | TailorEase</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #e6f0ff;
      margin: 0;
      padding: 0;
    }

    section.contact {
      max-width: 900px;
      margin: 50px auto;
      padding: 40px;
      background-color: white;
      border-radius: 16px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      color: #2e7d32;
      font-size: 28px;
      margin-bottom: 10px;
    }

    p.description {
      text-align: center;
      color: #666;
      margin-bottom: 40px;
    }

    .contact-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 40px;
    }

    .contact-info h3 {
      color: #333;
      margin-bottom: 8px;
    }

    .contact-info p {
      color: #555;
      margin: 4px 0;
    }

    form label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
      color: #444;
    }

    form input, form textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 8px;
      margin-bottom: 20px;
      font-size: 14px;
    }

    form button {
      background-color: #43b74c;
      color: white;
      font-weight: bold;
      padding: 10px 20px;
      border: none;
      border-radius: 9999px;
      cursor: pointer;
    }

    form button:hover {
      background-color: #369f3e;
    }

    footer {
      background-color: #2d3748;
      color: white;
      text-align: center;
      padding: 16px;
      margin-top: 50px;
    }

    @media screen and (max-width: 768px) {
      .contact-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>


  <section class="contact">
    <h2>Contact Us</h2>
    <p class="description">We’d love to hear from you! Reach out to us anytime using the contact details below.</p>

    <div class="contact-grid">
      <!-- Contact Info -->
      <div class="contact-info">
        <div>
          <h3>Phone Numbers</h3>
          <p>📞 0317-9921802</p>
          <p>📞 0335-9002887</p>
        </div>
        <div style="margin-top: 20px;">
          <h3>Email</h3>
          <p>📧 <a href="mailto:ammadahmad0987123@gmail.com" style="color: #2e7d32; text-decoration: none;">ammadahmad0987123@gmail.com</a></p>
        </div>
      </div>

      <!-- Contact Form -->
      <form>
        <div>
          <label>Your Name</label>
          <input type="text" placeholder="Enter your name" required>
        </div>
        <div>
          <label>Your Email</label>
          <input type="email" placeholder="Enter your email" required>
        </div>
        <div>
          <label>Message</label>
          <textarea rows="4" placeholder="Write your message..." required></textarea>
        </div>
        <button type="submit">Send Message</button>
      </form>
    </div>
  </section>

  <footer>
    <p>&copy; 2025 TailorEase. Beta Version.</p>
  </footer>

</body>
</html>
