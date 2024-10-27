<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crypto Sphere</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to bottom right, rgba(0, 123, 255, 0.2), rgba(0, 123, 255, 0.8)), white;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 90%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }
        .container:hover {
            transform: scale(1.02);
        }
        h1 {
            text-align: center;
            color: #333;
            font-size: 2.5em;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
            color: #555;
        }
        textarea {
            width: 100%;
            height: 100px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            font-size: 16px;
            resize: none;
            overflow: auto;
            transition: border-color 0.3s;
        }
        textarea:focus {
            border-color: #007BFF;
            outline: none;
        }
        select, button {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            border-radius: 5px;
            font-size: 16px;
            border: 1px solid #ccc;
            transition: border-color 0.3s;
        }
        select:focus, button:focus {
            border-color: #007BFF;
            outline: none;
        }
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }
        button:hover {
            background-color: #0056b3;
        }
        .result {
            margin-top: 20px;
            background: #e9ecef;
            padding: 15px;
            border-radius: 5px;
            word-wrap: break-word;
            border-left: 5px solid #007BFF;
        }
        pre {
            margin: 0;
            overflow: auto;
            white-space: pre-wrap;
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Mã hóa và giải mã dữ liệu</h1>
        <form method="post">
            <label for="inputData">Nhập dữ liệu :</label>
            <textarea id="inputData" name="inputData" wrap="soft"><?php echo isset($_POST['inputData']) ? htmlspecialchars($_POST['inputData']) : ''; ?></textarea>

            <label for="encodingOption">Chọn phương pháp:</label>
            <select id="encodingOption" name="encodingOption">
                <option value="">-- Chọn phương pháp --</option>
                <option value="base64">Base64</option>
                <option value="md5">MD5</option>
                <option value="sha256">SHA-256</option>
                <option value="sha512">SHA-512</option>
                <option value="url">URL Encoding</option>
                <option value="caesar">Caesar Cipher</option>
                <option value="binary">Mã nhị phân</option>
                <option value="hex">Mã hex</option>
                <option value="bcrypt">Bcrypt</option>
                <option value="morse">Mã Morse</option>
                <option value="brainrot">Brainrot</option>
                <option value="ascii">ASCII</option>
            </select>

            <label for="actionOption">Chọn hành động:</label>
            <select id="actionOption" name="actionOption">
                <option value="encode">Mã hóa</option>
                <option value="decode">Giải mã</option>
            </select>

            <button type="submit">Thực hiện</button>
        </form>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['encodingOption'])): ?>
            <div class="result">
                <h2>Kết quả:</h2>
                <pre>
<?php
                $input = $_POST['inputData'];
                switch ($_POST['actionOption']) {
                    case 'encode':
                        switch ($_POST['encodingOption']) {
                            case 'base64':
                                echo "Base64: " . base64_encode($input);
                                break;
                            case 'md5':
                                echo "MD5: " . md5($input);
                                break;
                            case 'sha256':
                                echo "SHA-256: " . hash('sha256', $input);
                                break;
                            case 'sha512':
                                echo "SHA-512: " . hash('sha512', $input);
                                break;
                            case 'url':
                                echo "URL Encoding: " . urlencode($input);
                                break;
                            case 'caesar':
                                echo "Caesar Cipher: " . caesarCipher($input, 3);
                                break;
                            case 'binary':
                                echo "Mã nhị phân: " . stringToBinary($input);
                                break;
                            case 'hex':
                                echo "Mã Hex: " . bin2hex($input);
                                break;
                            case 'bcrypt':
                                echo "Bcrypt: " . password_hash($input, PASSWORD_BCRYPT);
                                break;
                            case 'morse':
                                echo "Mã Morse: " . textToMorse($input);
                                break;
                            case 'brainrot':
                                echo "Brainrot: " . htmlspecialchars(brainrot($input));
                                break;
                            case 'ascii':
                                echo "ASCII: " . convertToASCII($input);
                                break;
                        }
                        break;

                    case 'decode':
                        switch ($_POST['encodingOption']) {
                            case 'base64':
                                echo "Base64: " . base64_decode($input);
                                break;
                            case 'url':
                                echo "URL Decoding: " . urldecode($input);
                                break;
                            case 'caesar':
                                echo "Caesar Cipher: " . caesarCipher($input, -3);
                                break;
                            case 'morse':
                                echo "Giải mã Mã Morse: " . morseToText($input);
                                break;
                            case 'binary':
                                $decoded = binaryToString($input);
                                if ($decoded === false) {
                                    echo "Giá trị nhị phân không hợp lệ.";
                                } else {
                                    echo "Giải mã nhị phân: " . $decoded;
                                }
                                break;
                            case 'hex':
                                if (ctype_xdigit($input)) {
                                    echo "Giải mã Hex: " . hex2bin($input);
                                } else {
                                    echo "Giá trị hex không hợp lệ.";
                                }
                                break;
                            case 'ascii':
                                echo "Giải mã ASCII: " . asciiToText($input);
                                break;
                            case 'md5':
                            case 'sha256':
                            case 'sha512':
                            case 'bcrypt':
                            case 'brainrot':
                                echo "Không thể giải mã cho phương pháp này.";
                                break;
                        }
                        break;
                }
?>
                </pre>
            </div>
        <?php endif; ?>
    </div>

    <?php
    function caesarCipher($str, $shift) {
        return implode('', array_map(function($char) use ($shift) {
            if (ctype_alpha($char)) {
                $code = ord($char);
                $base = ctype_upper($char) ? ord('A') : ord('a');
                return chr(($code - $base + $shift + 26) % 26 + $base);
            }
            return $char;
        }, str_split($str)));
    }

    function stringToBinary($string) {
        return implode(' ', array_map(function($char) {
            return sprintf('%08b', ord($char));
        }, str_split($string)));
    }

    function binaryToString($binary) {
        if (!preg_match('/^[01\s]+$/', $binary)) {
            return false; // Trả về false nếu không hợp lệ
        }

        $bytes = explode(' ', trim($binary));
        return implode('', array_map(function($byte) {
            return chr(bindec($byte));
        }, $bytes));
    }

    function textToMorse($text) {
        $morseCode = [
            'A' => '.-', 'B' => '-...', 'C' => '-.-.', 'D' => '-..', 'E' => '.', 'F' => '..-.', 'G' => '--.', 
            'H' => '....', 'I' => '..', 'J' => '.---', 'K' => '-.-', 'L' => '.-..', 'M' => '--', 'N' => '-.',
            'O' => '---', 'P' => '.--.', 'Q' => '--.-', 'R' => '.-.', 'S' => '...', 'T' => '-', 'U' => '..-', 
            'V' => '...-', 'W' => '.--', 'X' => '-..-', 'Y' => '-.--', 'Z' => '--..',
            '1' => '.----', '2' => '..---', '3' => '...--', '4' => '....-', '5' => '.....', '6' => '-....', 
            '7' => '--...', '8' => '---..', '9' => '----.', '0' => '-----', 
            ' ' => '/' // Dấu cách giữa các từ
        ];

        $text = strtoupper($text); // Chuyển đổi văn bản thành chữ hoa
        $morse = [];
        foreach (str_split($text) as $char) {
            if (array_key_exists($char, $morseCode)) {
                $morse[] = $morseCode[$char];
            }
        }
        return implode(' ', $morse);
    }

    function morseToText($morse) {
        $morseCode = [
            '.-' => 'A', '-...' => 'B', '-.-.' => 'C', '-..' => 'D', '.' => 'E', '..-.' => 'F', '--.' => 'G',
            '....' => 'H', '..' => 'I', '.---' => 'J', '-.-' => 'K', '.-..' => 'L', '--' => 'M', '-.' => 'N',
            '---' => 'O', '.--.' => 'P', '--.-' => 'Q', '.-.' => 'R', '...' => 'S', '-' => 'T', '..-' => 'U',
            '...-' => 'V', '.--' => 'W', '-..-' => 'X', '-.--' => 'Y', '--..' => 'Z',
            '.----' => '1', '..---' => '2', '...--' => '3', '....-' => '4', '.....' => '5', '-....' => '6',
            '--...' => '7', '---..' => '8', '----.' => '9', '-----' => '0',
            '/' => ' ' // Dấu cách giữa các từ
        ];

        $morseWords = explode(' ', trim($morse));
        $text = '';
        foreach ($morseWords as $code) {
            if (array_key_exists($code, $morseCode)) {
                $text .= $morseCode[$code];
            }
        }
        return $text;
    }

    function brainrot($input) {
        $brainrotWords = [
            "skibidi", "gyatt", "lit", "based", "ratio", "sus", "vibe check", "cap", 
            "bussin", "drip", "simp", "flex", "ghosting", "tea", "slay", "no cap", 
            "bet", "litty", "stan", "shook", "clout", "fire", "slaps", "yass", 
            "thirsty", "woke", "finesse", "banger", "cheugy", "sheesh", "snatched", 
            "bop", "ok boomer", "baddie", "lowkey", "highkey", "extra", "vibe", 
            "canceled", "goated", "deadass", "periodt", "fr", "bet", "slay", 
            "tea", "mood", "lit af", "king", "queen", "ratioed"
        ]; 
        $inputWords = explode(' ', $input);
        $output = [];
        foreach ($inputWords as $word) {
            if (rand(0, 1)) {
                $output[] = $brainrotWords[array_rand($brainrotWords)];
            } else {
                $output[] = $word;
            }
        }
        return htmlspecialchars(implode(' ', $output));
    }

    function convertToASCII($string) {
        return implode(' ', array_map(function($char) {
            return ord($char);
        }, str_split($string)));
    }

    function asciiToText($ascii) {
        $asciiArray = explode(' ', trim($ascii));
        $text = '';
        foreach ($asciiArray as $value) {
            if (is_numeric($value)) {
                $text .= chr((int)$value);
            }
        }
        return $text;
    }
    ?>

    <script>
        document.getElementById('encodingOption').addEventListener('change', function() {
            localStorage.setItem('selectedEncodingOption', this.value);
        });

        document.getElementById('actionOption').addEventListener('change', function() {
            localStorage.setItem('selectedActionOption', this.value);
        });

        window.addEventListener('load', function() {
            const savedEncodingOption = localStorage.getItem('selectedEncodingOption');
            const savedActionOption = localStorage.getItem('selectedActionOption');
            if (savedEncodingOption) {
                document.getElementById('encodingOption').value = savedEncodingOption;
            }
            if (savedActionOption) {
                document.getElementById('actionOption').value = savedActionOption;
            }
        });
    </script>
</body>
</html>
