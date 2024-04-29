<?php

namespace PuyuPe\Qillqay\Tests;

use PuyuPe\Qillqay\Generate;

use PHPUnit\Framework\TestCase;

class FromHtmlTest extends TestCase
{
    private $config;

    protected function setUp(): void
    {
        parent::setUp();
        $this->config = parse_ini_file(__DIR__ . '/config.ini');
    }

    public function testGeneratePdf()
    {
        $html = $this->getHtmlData();
        $wkhtmlPath = $this->config['wkhtmlPath'];
        $format = $this->config['format'];
        $size = 'ticket';
        $filePath = Generate::fromHtml($html, $format, $size, $wkhtmlPath, 'test', 320);

        $this->assertFileExists($filePath);
    }

    public function getHtmlData()
    {

        $data = '<!DOCTYPE html>
<html>
<head>
    <title>Complex HTML to PDF Example</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            background-color: #333;
        }

        nav li {
            display: inline;
            margin-right: 20px;
        }

        nav a {
            color: #fff;
            text-decoration: none;
        }

        main {
            padding: 20px;
        }

        section {
            margin-bottom: 30px;
            border: 1px solid #ddd;
            padding: 20px;
            background-color: #f9f9f9;
        }

        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to the Complex HTML to PDF Example</h1>
    </header>
    <nav>
        <ul>
            <li><a href="#section1">Section 1</a></li>
            <li><a href="#section2">Section 2</a></li>
            <li><a href="#section3">Section 3</a></li>
        </ul>
    </nav>
    <main>
        <section id="section1">
            <h2 class="text-primary">Section 1</h2>
            <p>This is the first section of our complex HTML document.</p>
            <ul>
                <li>Item 1</li>
                <li>Item 2</li>
                <li>Item 3</li>
            </ul>
        </section>
        <section id="section2">
            <h2 class="text-primary">Section 2</h2>
            <p>This is the second section of our complex HTML document.</p>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Age</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>John</td>
                        <td>30</td>
                    </tr>
                    <tr>
                        <td>Alice</td>
                        <td>25</td>
                    </tr>
                </tbody>
            </table>
        </section>
        <section id="section3">
            <h2 class="text-primary">Section 3</h2>
            <p>This is the third section of our complex HTML document.</p>
            <img src="https://via.placeholder.com/200" alt="Placeholder Image">
            <p>Click <a href="https://www.example.com">here</a> for more information.</p>
        </section>
    </main>
    <footer>
        <p>&copy; 2023 Complex HTML to PDF Example</p>
    </footer>
</body>
</html>
';
        return $data;

    }
}
