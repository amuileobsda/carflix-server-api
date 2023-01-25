## carflix-server-api
carflix-server-api server api문서를 관리하기 위함
    

## ERD
<img width="100%" src="https://user-images.githubusercontent.com/30142355/181522917-6b69d233-ee63-4018-bf6e-4ea3e7c75d6e.png"/>   

#### 6. code_car테이블 설명
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
#### 8. vehicle_status 테이블 설명
```
아두이노로부터 cr_id, member, vs_authentication_value를 받고
임의의 난수로 시동정보ID 생성해서 DB에 넣고 다시 아두이노로 전송

그후로 실시간으로 시동상태를 전송받는다.

이때 시동정보 ID와 위도, 경도를 받아서 DB에 계속 넣어주자.
처음에 시동 요청이 왔을 때 즉, 시동정보ID를 생성하기 전에는 위도, 경도에 0값을 넣어주자.
```   


### 테이블 구조
#### 1. member 테이블 구조
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


#### 2. small_group 테이블 구조
|컬럼명|컬럼타입|설명|
|------|---|---|
|`sg_id`|INT|PK|
|`mb_id`|INT|회원 테이블(member table)의 PK|
|`sg_title`|VARCHAR|소규모 그룹명|
|`sg_description`|VARCHAR|소규모 그룹설명|
|`status`|VARCHAR|default small_group|
|`sg_regdate`|DATETIME|소규모 그룹 생성일|


#### 3. ceo_group 테이블 구조
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


#### 4. rent_group 테이블 구조
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


#### 5. invite_code 테이블 구조
|컬럼명|컬럼타입|설명|
|------|---|---|
|`ic_id`|INT|PK|
|`mb_id`|INT|회원 관리 테이블의 PK|
|`group_id`|INT|그룹 아이디 PK|
|`status`|VARCHAR|그룹 상태값|
|`ic_number`|VARCHAR|초대 코드값|
|`ic_regdate`|DATETIME|초대코드 생성일|


#### 6. code_car 테이블 구조
|컬럼명|컬럼타입|설명|
|------|---|---|
|`cc_id`|INT|PK|
|`ic_number`|VARCHAR|초대 코드 값|
|`cr_id`|INT|차량등록 테이블(car_registeration table)의 PK|
|`group_id`|INT|그룹 아이디|
|`status`|VARCHAR|그룹 상태값|
|`member`|INT|초대코드 등록한 회원|
|`cc_regdate`|DATETIME|초대코드 받아서 등록한 날짜|


#### 7. car_registeration 테이블 구조
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


#### 8. vehicle_status 테이블 구조
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





