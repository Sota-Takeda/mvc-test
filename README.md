# 読書ログアプリ（Book CRUD）

## 概要
Laravel学習として、読書ログ（本の記録）をCRUDで管理できるアプリを作成しました。  
ログインしたユーザーが、自分の読んだ本を安全に管理できることを目的としています。

## 機能一覧
- 本のCRUD機能（一覧 / 詳細 / 登録 / 編集 / 削除）
- バリデーション（FormRequest）
- ユーザー登録 / ログイン / ログアウト（Laravel Breeze）
- 認証によるアクセス制御（auth middleware）
- ユーザー別データ管理（books.user_id）
- 権限制御（Policyで他人の編集・削除を403で拒否）
- 一覧検索（GET）
- ページネーション（検索条件を保持）
- ソフトデリート（論理削除）＋削除済み一覧・復元

## 画面
- 一覧ページ：`/books`
- 新規登録：`/books/create`
- 詳細ページ：`/books/{id}`
- 編集ページ：`/books/{id}/edit`
- 削除済み一覧：`/books/trashed`

## 使用技術
- PHP 8.x
- Laravel 10.x
- MySQL
- Blade（テンプレートエンジン）

## テーブル設計
### books
- id
- title（必須）
- author（任意）
- status（必須）
- memo（任意）
- started_at（任意）
- finished_at（任意）
- created_at / updated_at
- deleted_at（ソフトデリート）
- user_id（必須：ログインユーザーと紐付け）

## 学んだこと / 工夫した点
- 認証（Laravel Breeze）を導入し、「登録→ログイン→ログアウト」を実装しました。
- booksルートはauth middlewareで保護し、未ログイン状態で/booksにアクセスできないようにしました。
- booksテーブルにuser_idを追加し、ログインユーザーごとにデータを分離しました。
- Policy（BookPolicy）を導入し、ログインしていても他人のBookを編集・削除できないようにしました。
- 検索はGETメソッドを使用し、URL共有や再読み込みが可能な設計にしました。
- 一覧表示は paginate を利用し、全件取得による負荷を避けました。
- 検索条件がページ移動で消えないように withQueryString() を利用しました。
- ソフトデリートを導入し、誤削除時に復元できるようにしました。

## 苦労した点
- HTMLフォームではPUT/PATCH/DELETEを送れないため、`@method` を使って擬似的にHTTPメソッドを切り替えて対応しました。
- 検索条件とページネーションを同時に扱う際、条件が消えないようクエリ設計を工夫しました。

## 今後追加したい機能
- ステータスの選択肢を enum 化して、値の整合性を保つ
- 読書期間による絞り込み
