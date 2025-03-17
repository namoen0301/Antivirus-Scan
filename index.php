<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <link rel="icon" href="favicon.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>杀软在线识别-渊龙Sec安全团队</title>
    <style>
        :root {
            --primary-color: #4285f4;
            --secondary-color: #34a853;
            --danger-color: #ea4335;
            --info-color: #fbbc05;
            --dark-color: #333;
            --light-color: #f8f9fa;
            --border-radius: 8px;
            --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            color: var(--dark-color);
            line-height: 1.6;
        }
        
        .container {
            width: 80%;
            max-width: 900px;
            padding: 40px;
            text-align: center;
            background-color: white;
            box-shadow: var(--box-shadow);
            border-radius: var(--border-radius);
            margin: 20px 0;
            transition: var(--transition);
        }
        
        .container:hover {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        }
        
        h1 {
            color: var(--primary-color);
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        h3 {
            font-weight: 400;
            color: #555;
            margin-bottom: 25px;
            font-size: 1rem;
        }
        
        a {
            color: var(--primary-color);
            text-decoration: none;
            transition: var(--transition);
        }
        
        a:hover {
            text-decoration: underline;
            color: #1a73e8;
        }
        
        textarea {
            width: 100%;
            height: 200px;
            margin-top: 20px;
            padding: 15px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            resize: vertical;
            transition: var(--transition);
            font-family: 'Consolas', monospace;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(66, 133, 244, 0.2);
        }
        
        .button-group {
            margin-top: 25px;
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }
        
        button {
            padding: 12px 25px;
            font-size: 15px;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: var(--transition);
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        button:focus {
            outline: none;
        }
        
        .submit-button {
            background-color: var(--primary-color);
            color: white;
        }
        
        .submit-button:hover {
            background-color: #1a73e8;
            transform: translateY(-2px);
        }
        
        .clear-button {
            background-color: var(--danger-color);
            color: white;
        }
        
        .clear-button:hover {
            background-color: #d62516;
            transform: translateY(-2px);
        }
        
        .copy-button {
            background-color: var(--info-color);
            color: var(--dark-color);
        }
        
        .copy-button:hover {
            background-color: #e8ae00;
            transform: translateY(-2px);
        }
        
        .command-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
            position: relative;
        }
        
        #commandInput {
            width: 250px;
            padding: 12px 15px;
            font-size: 15px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            text-align: center;
            background-color: #f5f5f5;
            font-family: 'Consolas', monospace;
            color: var(--dark-color);
            transition: var(--transition);
        }
        
        #commandInput:focus {
            outline: none;
            border-color: var(--primary-color);
        }
        
        .result {
            margin: 30px 0;
            font-size: 16px;
            color: var(--dark-color);
            background-color: var(--light-color);
            padding: 20px;
            border-radius: var(--border-radius);
            max-height: 350px;
            overflow-y: auto;
            border-left: 4px solid var(--secondary-color);
            text-align: left;
        }
        
        .result p {
            margin: 10px 0;
            padding: 8px;
            border-radius: 4px;
            background-color: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }
        
        .result p strong {
            color: var(--primary-color);
        }
        
        .result a {
            font-weight: 500;
        }
        
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }
        
        .copy-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: var(--secondary-color);
            color: white;
            padding: 10px 20px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            opacity: 0;
            transform: translateY(-20px);
            transition: opacity 0.3s, transform 0.3s;
            z-index: 1000;
        }
        
        .copy-notification.show {
            opacity: 1;
            transform: translateY(0);
        }
        
        @media (max-width: 768px) {
            .container {
                width: 95%;
                padding: 20px;
            }
            
            .button-group {
                flex-direction: column;
                gap: 10px;
            }
            
            button {
                width: 100%;
            }
        }
    </style>
    <script>
        function clearTextarea() {
            document.getElementById('user_input').value = '';
        }

        function copyToClipboard() {
            var copyText = document.getElementById("commandInput");
            copyText.select();
            copyText.setSelectionRange(0, 99999); // 对移动设备有用
            document.execCommand("copy");
            
            // 显示通知
            const notification = document.createElement('div');
            notification.className = 'copy-notification';
            notification.textContent = '已复制: ' + copyText.value;
            document.body.appendChild(notification);
            
            // 触发重排以应用动画
            setTimeout(() => {
                notification.classList.add('show');
            }, 10);
            
            // 2秒后将移除通知
            setTimeout(() => {
                notification.classList.remove('show');
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 2000);
        }
    </script>
</head>
<body>
    <div class="container">
<?php
// 初始化变量
$result = '';
$input = '';

// 处理 POST 请求
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = $_POST['user_input'] ?? '';

    // 按行拆分输入的内容
    $lines = explode("\n", $input);

    // 格式化处理：找到每行中的 " K " 和 " KB " 并换行处理
    $formattedLines = [];
    foreach ($lines as $line) {
        $line = trim($line);

        // 处理 " KB " 的格式化
        if (strpos($line, ' KB ') !== false) {
            $parts = explode('KB', $line);
            foreach ($parts as $key => $part) {
                $formattedLines[] = trim($part) . ($key < count($parts) - 1 ? 'KB' : '');
            }
        } 
        // 处理 " K " 的格式化
        elseif (strpos($line, ' K ') !== false) {
            $parts = explode('K', $line);
            foreach ($parts as $key => $part) {
                $formattedLines[] = trim($part) . ($key < count($parts) - 1 ? 'K' : '');
            }
        } else {
            $formattedLines[] = $line;
        }
    }

    // 重组格式化后的文本
    $formattedText = implode("\n", $formattedLines);

    // 从 JSON 文件读取数据
    $jsonData = file_get_contents('auto.json');
    $data = json_decode($jsonData, true);

    // 匹配处理
    $matches = [];
    foreach (explode("\n", $formattedText) as $line) {
        foreach ($data as $key => $value) {
            foreach ($value['processes'] as $process) {
                if (stripos($line, $process) === 0) { // 仅匹配每行的开头部分，且忽略大小写
                    // 如果软件名已存在，则添加到现有的进程列表中
                    if (!isset($matches[$key])) {
                        $matches[$key] = [
                            'url' => $value['url'],
                            'processes' => []
                        ];
                    }
                    $matches[$key]['processes'][] = htmlspecialchars($process);
                }
            }
        }
    }
    // 去重每个软件名对应的进程列表
    foreach ($matches as $key => $details) {
        $matches[$key]['processes'] = array_unique($details['processes']);
    }

    // 生成 HTML 显示结果
    if (count($matches) > 0) {
        foreach ($matches as $softwareName => $details) {
            $result .= "<p><strong>" . htmlspecialchars($softwareName) . ":</strong> " 
                        . implode(', ', $details['processes']) . " ==> <a href=\"" 
                        . htmlspecialchars($details['url']) . "\" target=\"_blank\">" 
                        . htmlspecialchars($details['url']) . "</a></p>";
        }
    } else {
        $result = "<p>未找到匹配的进程，如有漏报欢迎提交至我们的开源项目</br><a href=\"https://github.com/Aabyss-Team/Antivirus-Scan\">https://github.com/Aabyss-Team/Antivirus-Scan</a></p>";
    }
}
?>
        <!-- 表单 -->
        <h1>杀软在线识别-<a href="https://www.aabyss.cn">渊龙Sec安全团队</a></h1>
        <h3>如有漏报欢迎提交至我们的开源项目<br><a href="https://github.com/Aabyss-Team/Antivirus-Scan">https://github.com/Aabyss-Team/Antivirus-Scan</a></h3>
        
        <form action="index.php" method="POST">
            <textarea name="user_input" id="user_input" placeholder="在此输入 tasklist /SVC 命令的执行结果..."><?php echo htmlspecialchars($input); ?></textarea>
            
            <div class="command-container">
                <input type="text" id="commandInput" value="tasklist /SVC" readonly>
            </div>
            
            <div class="button-group">
                <button type="submit" class="submit-button">提交分析</button>
                <button type="button" class="clear-button" onclick="clearTextarea()">清空内容</button>
                <button type="button" class="copy-button" onclick="copyToClipboard()">复制命令</button>
            </div>
        </form>
        
        <!-- 结果显示区域 -->
        <?php if ($result !== ''): ?>
            <div class="result">
                <h3 style="text-align: center; margin-bottom: 15px; color: var(--secondary-color);">分析结果</h3>
                <?php echo $result; ?>
            </div>
        <?php endif; ?>
        
        <div class="footer">
            <p>项目版本号 V1.7.4-2025.3</p>
        </div>
    </div>
</body>
</html>
