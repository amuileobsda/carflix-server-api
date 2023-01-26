## carflix-server-api
carflix-server-api server api문서를 관리하기 위함

|개발자|메일|
|------|---|
|`최정길`|legend_gil@naver.com|    
    
    
## 1. ERD

개체-관계 모델. 테이블간의 관계를 설명해주는 다이어그램이라고 볼 수 있으며, 

이를 통해 프로젝트에서 사용되는 DB의 구조를 한눈에 파악할 수 있다.

즉, API를 효율적으로 뽑아내기 위한 모델 구조도라고 생각하면 된다.

<img width="100%" src="https://user-images.githubusercontent.com/30142355/181522917-6b69d233-ee63-4018-bf6e-4ea3e7c75d6e.png"/>   

### 1.1. ERD 상세설명
### 1.1.1. code_car테이블 설명

<details><summary style="color:skyblue">CLICK ME</summary>
<p>
    
```
ic_number를 받은 사용자는 해당 ic_number를 등록하면 동시에
invite_code에서 받아온 group_id, status, mb_id를 
car_registeration로 보내서
해당 차량들 같이 보이게 한다.

사용자는 초대코드는 무조건 한번등록
중복 등록 안되고
등록전에 이미 초대코드 발급 받았는지 체크

초대코드로 발급받은 그룹은 사용자가 그룹 삭제시
테이블에서 찾아서 cc_id 삭제하면 그룹해제됨
```   
</p>
</details>    
    
### 1.1.2. vehicle_status 테이블 설명

<details><summary style="color:skyblue">CLICK ME</summary>
<p>
    
```
아두이노로부터 cr_id, member, vs_authentication_value를 받고
임의의 난수로 시동정보ID 생성해서 DB에 넣고 다시 아두이노로 전송

그후로 실시간으로 시동상태를 전송받는다.

이때 시동정보 ID와 위도, 경도를 받아서 DB에 계속 넣어주자.
처음에 시동 요청이 왔을 때 즉, 시동정보ID를 생성하기 전에는 위도, 경도에 0값을 넣어주자.
```   
</p>
</details>  
    
    

## 2. 테이블 구조

### 2.1. member 테이블 구조
|컬럼명|컬럼타입|설명|
|------|---|---|
|`mb_id`|INT|PK|
|`mb_userid`|VARCHAR|회원 아이디|
|`mb_password`|VARCHAR|회원 패스워드|
|`mb_email`|VARCHAR|회원 이메일|
|`mb_phone`|VARCHAR|연락처|
|`mb_nickname`|VARCHAR|회원 닉네임|
|`mb_image`|VARCHAR|회원 이미지|
|`mb_is_admin`|TINYINT|최고관리자인지 여부 default N|
|`mb_register_car`|TINYINT|관리자로부터 차량 등록 여부|
|`mb_lastlogin_datetime`|VARCHAR|최종 로그인 시간|
|`mb_regdate`|DATETIME|회원 가입일|


### 2.2. small_group 테이블 구조
|컬럼명|컬럼타입|설명|
|------|---|---|
|`sg_id`|INT|PK|
|`mb_id`|INT|회원 테이블(member table)의 PK|
|`sg_title`|VARCHAR|소규모 그룹명|
|`sg_description`|VARCHAR|소규모 그룹설명|
|`status`|VARCHAR|default small_group|
|`sg_regdate`|DATETIME|소규모 그룹 생성일|


### 2.3. ceo_group 테이블 구조
|컬럼명|컬럼타입|설명|
|------|---|---|
|`cg_id`|INT|PK|
|`mb_id`|INT|회원 테이블(member table)의 PK|
|`cg_career`|VARCHAR|대규모 대표 경력|
|`cg_certificate`|VARCHAR|증명서|
|`cg_company_registernumber`|VARCHAR|사업자등록번호|
|`cg_title`|VARCHAR|대규모 그룹명|
|`cg_description`|VARCHAR|대규모 그룹설명|
|`status`|VARCHAR|default ceo_group|
|`cg_regdate`|DATETIME|대규모 그룹 생성일|


### 2.4. rent_group 테이블 구조
|컬럼명|컬럼타입|설명|
|------|---|---|
|`rg_id`|INT|PK|
|`mb_id`|INT|회원 테이블(member table)의 PK|
|`rg_career`|VARCHAR|렌트카 대표 경력|
|`rg_certificate`|VARCHAR|증명서|
|`rg_company_registernumber`|VARCHAR|사업자등록번호|
|`rg_title`|VARCHAR|렌트카 그룹명|
|`rg_description`|VARCHAR|렌트카 그룹설명|
|`status`|VARCHAR|default rent_group|
|`rg_regdate`|DATETIME|렌트카 그룹 생성일|


### 2.5. invite_code 테이블 구조
|컬럼명|컬럼타입|설명|
|------|---|---|
|`ic_id`|INT|PK|
|`mb_id`|INT|회원 관리 테이블의 PK|
|`group_id`|INT|그룹 아이디 PK|
|`status`|VARCHAR|그룹 상태값|
|`ic_number`|VARCHAR|초대 코드값|
|`ic_regdate`|DATETIME|초대코드 생성일|


### 2.6. code_car 테이블 구조
|컬럼명|컬럼타입|설명|
|------|---|---|
|`cc_id`|INT|PK|
|`ic_number`|VARCHAR|초대 코드 값|
|`cr_id`|INT|차량등록 테이블(car_registeration table)의 PK|
|`group_id`|INT|그룹 아이디|
|`status`|VARCHAR|그룹 상태값|
|`member`|INT|초대코드 등록한 회원|
|`cc_regdate`|DATETIME|초대코드 받아서 등록한 날짜|


### 2.7. car_registeration 테이블 구조
|컬럼명|컬럼타입|설명|
|------|---|---|
|`cr_id`|INT|PK|
|`mb_id`|INT|회원 테이블(member table)의 PK/등록한 사람|
|`group_id`|INT|그룹 아이디의 PK|
|`status`|VARCHAR|소규모, 대규모, 렌트카에서 등록한차인지에 대한 구분|
|`cr_number_classification`|VARCHAR|자동차 번호 분류|
|`cr_registeration_number`|VARCHAR|자동차 등록 번호|
|`cr_carname`|VARCHAR|자동차 이름|
|`cr_mac_address`|VARCHAR|자동차 mac주소|
|`cr_regdate`|DATETIME|자동차 등록일|


### 2.8. vehicle_status 테이블 구조
|컬럼명|컬럼타입|설명|
|------|---|---|
|`vs_id`|INT|PK|
|`vs_startup_information`|VARCHAR|시동정보 ID|
|`cr_id`|INT|자동차 ID|
|`member`|INT|지금 차에탄 사람|
|`vs_authentication_value`|VARCHAR|인증값 default ok|
|`vs_latitude`|VARCHAR|자동차 현재 위도|
|`vs_longitude`|VARCHAR|자동차 현재 경도|
|`vs_regdate`|DATETIME|시동걸린시간|



## 3. API 문서화

### 3.1. 회원
|REST|설명|URL|
|------|---|---|
|`GET`|전체회원 조회|/admin/api/member/read.php|
|`GET`|특정회원 조회|/admin/api/member/show.php?mb_id=1|
|`POST`|회원생성|/admin/api/member/create.php|
|`PUT`|특정회원 정보 업데이트|/admin/api/member/update.php|
|`DEL`|특정회원 삭제|/admin/api/member/delete.php|
|`GET`|회원 아이디 중복 조회|/admin/api/member/show_single_name.php?mb_userid=testtesttest|
|`GET`|로그인|/admin/api/member/login_v3.php?mb_userid=test&mb_password=test|


### 3.2. 차량
|REST|설명|URL|
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


### 3.3. 소규모그룹
|REST|설명|URL|
|------|---|---|
|`GET`|전체 소규모그룹 조회|/admin/api/small_group/read.php|
|`GET`|특정 소규모그룹 조회|/admin/api/small_group/show.php?sg_id=1|
|`PUT`|특정 소규모그룹 정보 업데이트|/admin/api/small_group/update.php|
|`POST`|소규모그룹 생성|/admin/api/small_group/create.php|
|`DEL`|특정 소규모그룹 삭제|/admin/api/small_group/delete.php|
|`GET`|회원 아이디로 등록되어있는 전체 소규모그룹 조회|/admin/api/small_group/group_info.php?mb_id=2|


### 3.4. 대규모그룹
|REST|설명|URL|
|------|---|---|
|`GET`|전체 대규모그룹 조회|/admin/api/ceo_group/read.php|
|`GET`|특정 대규모그룹 조회|/admin/api/ceo_group/show.php?cg_id=1|
|`POST`|대규모그룹 생성|/admin/api/ceo_group/create.php|
|`PUT`|특정 대규모그룹 정보 업데이트|/admin/api/ceo_group/update.php|
|`DEL`|특정 대규모그룹 삭제|/admin/api/ceo_group/delete.php|
|`GET`|회원 아이디로 등록되어있는 전체 대규모그룹 조회|/admin/api/ceo_group/group_info.php?mb_id=2|


### 3.5. 렌트그룹
|REST|설명|URL|
|------|---|---|
|`GET`|전체 렌트그룹 조회|/admin/api/rent_group/read.php|
|`GET`|특정 렌트그룹 조회|/admin/api/rent_group/show.php?rg_id=1|
|`POST`|렌트그룹 생성|/admin/api/rent_group/create.php|
|`PUT`|특정 렌트그룹 정보 업데이트|/admin/api/rent_group/update.php|
|`DEL`|특정 렌트그룹 삭제|/admin/api/rent_group/delete.php|
|`GET`|회원 아이디로 등록되어있는 전체 렌트그룹 조회|/admin/api/rent_group/group_info.php?mb_id=2|


### 3.6. 초대코드
|REST|설명|URL|
|------|---|---|
|`GET`|생성된 전체 초대코드 조회|/admin/api/invite_code/read.php|
|`GET`|특정 회원이 생성한 전체 초대코드|/admin/api/invite_code/show.php?mb_id=2|
|`POST`|초대코드 생성|/admin/api/invite_code/create.php|
|`POST`|대표가 생성한 초대코드 받아서 회원이 등록|/admin/api/code_car/create.php|
|`DEL`|그룹 해제|/admin/api/code_car/delete.php|


### 3.7. 차량상태
|REST|설명|URL|
|------|---|---|
|`GET`|특정 차량상태 최신순으로 120개 불러옴|/admin/api/vehicle_status/show.php?cr_id=2|
|`POST`|시동상태 전송|/admin/api/vehicle_status/boot_status.php|
|`POST`|시동꺼짐 정보전송|/admin/api/vehicle_status/connection_status.php|
|`POST`|아두이노에 문제있을때 앱에서 서버로 보내는 상태|/admin/api/code_car/create.php|
|`GET`|시동요청이 올바른지 체크|/admin/api/vehicle_status/boot_on.php?cr_id=3&mb_id=4|
|`GET`|차량이 락인지 언락인지 체크|/admin/api/vehicle_status/lockunlock.php?cr_id=3&mb_id=4&how=trunk_lock|
|`GET`|현재 이차량이 시동가능한지 시동중인지 체크|/admin/api/vehicle_status/vehicle_condition.php?cr_id=3|


