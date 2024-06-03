# LINE Bot

這是一個基於貓旅購物網。整合了 LINE Bot 與 OpenAI API，實現回覆訊息的功能。目前這個專案在 LINE 上加入帳號進行測試，並使用 ngrok 來進行伺服器連線。

## 目錄
- [專案介紹](#專案介紹)
- [功能特性](#功能特性)
- [系統需求](#系統需求)
- [安裝步驟](#安裝步驟)
- [如何使用](#如何使用)
- [配置環境](#配置環境)
- [ngrok](#ngrok)
- [使用方法測試](#使用方法測試)

## 專案介紹
用戶可以通過網站訂購貓咪旅館的房間，還可以購買各種貓咪相關的商品。新增了 LINE Bot 功能，用戶可以通過 LINE 機器人瞭解相關資訊。我們使用 OpenAI 的 API ，提供智能化的客服體驗。

## 功能特性
- LINE Bot 整合
- 回覆訊息 (OpenAI API)


## 系統需求
- PHP
- Laravel
- Composer
- ngrok

## 安裝步驟
1.  git clone my-project

2.  cd my-project
    
3.  composer install
   
4.  cp .env.example .env
    
5.  php artisan key:generate
  
6.  php artisan serve
    open http://localhost:8000

## 如何使用?
1. 註冊平台：包括 GitHub、ngrok、OpenAI API、LINE Developers。

2. 取得 OpenAI API token

3. 建立 LINE Developer Channel，並取得 Channel Secret 、 Channel Access Token

4. 綁定在 LINE Channel Webhook (ngrok的專案網址/webhook)

加入LINE官方帳號，使用者對話將由 ChatGPT-3.5-tubo回應(LINE自動回應須關閉)。

## 配置環境
1. 配置 `.env` 環境變量:
    ```plaintext
    LINE_CHANNEL_ACCESS_TOKEN=LINE Channel Access Token
    LINE_CHANNEL_SECRET=LINE Channel Secret
    OPENAI_API_KEY=OpenAI API Key
    ```

## ngrok
1. 下載並安裝 ngrok: [ngrok 官網](https://ngrok.com/)
2. 啟動 ngrok 並建立 HTTP :
    ```bash
    ngrok http 8000
    ```
3. 將生成的 ngrok URL 配置到 LINE Developer 中 Webhook URL 。


## 使用方法測試
1. 在 LINE 應用中加入帳號，開始與機器人互動測試。


