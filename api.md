## API 문서화

API는 응용 프로그램에서 사용할 수 있도록, 운영 체제나 프로그래밍 언어가 제공하는 기능을 제어할 수 있게 만든 인터페이스를 뜻한다.


### 1. 회원
|METHOD|설명|URI|
|------|---|---|
|`GET`|전체회원 조회|/admin/api/member/read.php|
|`GET`|특정회원 조회|/admin/api/member/show.php?mb_id=1|
|`POST`|회원생성|/admin/api/member/create.php|
|`PUT`|특정회원 정보 업데이트|/admin/api/member/update.php|
|`DEL`|특정회원 삭제|/admin/api/member/delete.php|
|`GET`|회원 아이디 중복 조회|/admin/api/member/show_single_name.php?mb_userid=testtesttest|
|`GET`|로그인|/admin/api/member/login_v3.php?mb_userid=test&mb_password=test|


### 2. 차량
|METHOD|설명|URI|
|------|---|---|
|`GET`|전체차량 조회|/admin/api/car/read.php|
|`GET`|특정차량 조회|/admin/api/car/show.php?cr_id=1|
|`POST`|차량생성|/admin/api/car/create.php|
|`PUT`|특정차량 정보 업데이트|/admin/api/car/update.php|
|`DEL`|특정차량 삭제|/admin/api/car/delete.php|
|`GET`|그룹에 등록된 차량 조회|/admin/api/car/group_show.php?mb_id=3&group_id=2&status=ceo_group|
|`DEL`|차량 등록 해제 성공후 제거|/admin/api/car/registration_delete.php|
|`GET`|차량 등록 해제 요청|/admin/api/car/registration_delete_request.php|
|`DEL`|맥 주소로 차량 삭제|/admin/api/car/macaddress_delete.php|


### 3. 소규모그룹
|METHOD|설명|URI|
|------|---|---|
|`GET`|전체 소규모그룹 조회|/admin/api/small_group/read.php|
|`GET`|특정 소규모그룹 조회|/admin/api/small_group/show.php?sg_id=1|
|`PUT`|특정 소규모그룹 정보 업데이트|/admin/api/small_group/update.php|
|`POST`|소규모그룹 생성|/admin/api/small_group/create.php|
|`DEL`|특정 소규모그룹 삭제|/admin/api/small_group/delete.php|
|`GET`|회원 아이디로 등록되어있는 전체 소규모그룹 조회|/admin/api/small_group/group_info.php?mb_id=2|


### 4. 대규모그룹
|METHOD|설명|URI|
|------|---|---|
|`GET`|전체 대규모그룹 조회|/admin/api/ceo_group/read.php|
|`GET`|특정 대규모그룹 조회|/admin/api/ceo_group/show.php?cg_id=1|
|`POST`|대규모그룹 생성|/admin/api/ceo_group/create.php|
|`PUT`|특정 대규모그룹 정보 업데이트|/admin/api/ceo_group/update.php|
|`DEL`|특정 대규모그룹 삭제|/admin/api/ceo_group/delete.php|
|`GET`|회원 아이디로 등록되어있는 전체 대규모그룹 조회|/admin/api/ceo_group/group_info.php?mb_id=2|


### 5. 렌트그룹
|METHOD|설명|URI|
|------|---|---|
|`GET`|전체 렌트그룹 조회|/admin/api/rent_group/read.php|
|`GET`|특정 렌트그룹 조회|/admin/api/rent_group/show.php?rg_id=1|
|`POST`|렌트그룹 생성|/admin/api/rent_group/create.php|
|`PUT`|특정 렌트그룹 정보 업데이트|/admin/api/rent_group/update.php|
|`DEL`|특정 렌트그룹 삭제|/admin/api/rent_group/delete.php|
|`GET`|회원 아이디로 등록되어있는 전체 렌트그룹 조회|/admin/api/rent_group/group_info.php?mb_id=2|


### 6. 초대코드
|METHOD|설명|URI|
|------|---|---|
|`GET`|생성된 전체 초대코드 조회|/admin/api/invite_code/read.php|
|`GET`|특정 회원이 생성한 전체 초대코드|/admin/api/invite_code/show.php?mb_id=2|
|`POST`|초대코드 생성|/admin/api/invite_code/create.php|
|`POST`|대표가 생성한 초대코드 받아서 회원이 등록|/admin/api/code_car/create.php|
|`DEL`|그룹 해제|/admin/api/code_car/delete.php|


### 7. 차량상태
|METHOD|설명|URI|
|------|---|---|
|`GET`|특정 차량상태 최신순으로 120개 불러옴|/admin/api/vehicle_status/show.php?cr_id=2|
|`POST`|시동상태 전송|/admin/api/vehicle_status/boot_status.php|
|`POST`|시동꺼짐 정보전송|/admin/api/vehicle_status/connection_status.php|
|`POST`|아두이노에 문제있을때 앱에서 서버로 보내는 상태|/admin/api/code_car/create.php|
|`GET`|시동요청이 올바른지 체크|/admin/api/vehicle_status/boot_on.php?cr_id=3&mb_id=4|
|`GET`|차량이 락인지 언락인지 체크|/admin/api/vehicle_status/lockunlock.php?cr_id=3&mb_id=4&how=trunk_lock|
|`GET`|현재 이차량이 시동가능한지 시동중인지 체크|/admin/api/vehicle_status/vehicle_condition.php?cr_id=3|   

