## Capstone Design Web
```
* capstone design web의 소스 코드를 상업적으로 이용하지 마세요.
```

[테스트 계정]
---
<details>
<summary>접기/펼치기</summary>
<div markdown="1">
  
|권한|username|password|
|--|--|--|
|관리자|admin|admin|
|사용자|user|user|
  
</div>
</details>

[데이터베이스 테이블 구조]
---
<details>
<summary>접기/펼치기</summary>
<div markdown="1">
  
|users|user_sign_log|user_admin_log|
|--|--|--|
|id|idx|idx|
|username|||
||connected_id|connected_id|
|password|||
|||category|
|ipaddress|ipaddress|ipaddress|
|role|||
|created_at|datetime|datetime|
  
</div>
</details>

[회원가입]
---
수집하는 정보
- 아이디, 패스워드, 접속 IP, 날짜 및 시간
  - 패스워드는 암호화 과정을 거쳐 저장됩니다.

[로그인]
---
수집하는 정보(계정 도용과 같은 문제가 발생시 문의를 통해 증명해야 하는 경우에 사용)
- 접속 IP, 날짜 및 시간

[회원탈퇴]
---
회원탈퇴 버튼을 누르면 누르는 즉시 삭제됩니다.   
- 로그인 Log는 삭제되지 않습니다.   
- 만약 Admin 권한을 가지고 있었던 경우에 수집되는 삭제 Log는 삭제되지 않습니다.

[.htaccess 파일]
---
capstone_design_web 폴더에 있는 ".htaccess.example" 파일 확장자 ".example"을 삭제한다.   
또는   
.htaccess 만들기
```


Options +MultiViews
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^([^\.]+)$ $1.php [NC,L]
```
