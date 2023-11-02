## Capstone Design Web
```
* capstone design web의 소스 코드를 상업적으로 이용하지 마세요.
```

[데이터베이스 테이블 구조]
---
<details>
<summary>접기/펼치기</summary>
<div markdown="1">
  
|users|user_sign_log|user_admin_log|
|--|--|--|
|id|idx||idx|
|username|connected_id|connected_id|
|password|ipaddress|category|
|ipaddress|datetime|ipaddress|
|role||datetime|
|created_at|||
  
</div>
</details>
======================

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
로그인 Log는 삭제되지 않습니다.   
만약 Admin 권한을 가지고 있었던 경우에 수집되는 삭제 Log는 삭제되지 않습니다.
