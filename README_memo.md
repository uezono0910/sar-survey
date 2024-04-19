## エイリアスの設定
エイリアスの設定の目的は、コマンド実行の際にパスを指定する必要があるため、パスなしでコマンド実行ができるようにする
```
./vendor/bin/sail up -d
```
### ホームディレクトリに.bashrcファイルを作成し以下を記述
```
alias sail="./vendor/bin/sail"
```

### Shellを「bash」にして、変更を反映
```
source ~/.bashrc
```

### エイリアスの確認
```
alias sail

// 以下が表示されたらOK
alias sail='./vendor/bin/sail'
```

### sailでDockerを起動
```
sail up -d
```

### dev スクリプトを実行
sail npm run dev