# 読書ログアプリ（Book CRUD）

## 概要
Laravel学習として、読書ログ（本の記録）をCRUDで管理できるアプリを作成しました。  
本のタイトル・著者・読書ステータス・メモ・読書期間を登録し、一覧・詳細・編集・削除ができます。

## 機能一覧
- 本の一覧表示（Read）
- 本の詳細表示（Show）
- 本の新規登録（Create）
- 本の編集・更新（Update）
- 本の削除（Delete）
- バリデーション（入力チェック）

## 画面
- 一覧ページ：`/books`
- 新規登録：`/books/create`
- 詳細ページ：`/books/{id}`
- 編集ページ：`/books/{id}/edit`

## 使用技術
- PHP
- Laravel
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

## 学んだこと / 工夫した点
- MVCの役割を意識して実装しました（取得はModel、処理はController、表示はView）。
- バリデーションを使用し、安全なデータのみを保存するようにしました。
- Route Model Bindingにより、URLのidから対象データを取得し、編集・削除できるようにしました。

## 苦労した点
- HTMLフォームではPUT/PATCH/DELETEを送れないため、`@method` を使って擬似的にリクエストメソッドを切り替えて対応しました。

## 今後追加したい機能
- 検索機能
- ページネーション
- ソフトデリート（論理削除）
- ステータスの選択肢を固定化（enum化）
