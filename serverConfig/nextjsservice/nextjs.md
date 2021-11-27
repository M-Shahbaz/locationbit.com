nano /etc/systemd/system/nextjs.service

npm run dev
npm run build
npm run start
systemctl start nextjs
systemctl restart nextjs
systemctl stop nextjs

tail -f /var/log/www/locationbit.com/common.log

[git]
cd /var/www/locationbit.com
git pull origin
M-Shahbaz
npm run build
systemctl restart nextjs
