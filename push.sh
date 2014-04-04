echo 'input push comment:'
read text

git add .

git commit -a -m "$text"

git push
