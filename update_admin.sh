#!/bin/bash
cd /home/rikkyvish/royalweb/royal-gcollection-laravel
mysql -u royal_user -p'Rikkyvish@12' royal_gcollection <<EOF
UPDATE users SET is_admin = 1 WHERE email = 'admin@example.com';
EOF
echo "Admin user updated successfully!"
