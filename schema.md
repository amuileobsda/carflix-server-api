## 테이블 구조

관계형 데이터베이스에서 데이터들을 목록별로 정리해서 완성된 하나의 집합체를 테이블이라고 합니다.


### 1. member 테이블 구조
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


### 2. small_group 테이블 구조
|컬럼명|컬럼타입|설명|
|------|---|---|
|`sg_id`|INT|PK|
|`mb_id`|INT|회원 테이블(member table)의 PK|
|`sg_title`|VARCHAR|소규모 그룹명|
|`sg_description`|VARCHAR|소규모 그룹설명|
|`status`|VARCHAR|default small_group|
|`sg_regdate`|DATETIME|소규모 그룹 생성일|


### 3. ceo_group 테이블 구조
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


### 4. rent_group 테이블 구조
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


### 5. invite_code 테이블 구조
|컬럼명|컬럼타입|설명|
|------|---|---|
|`ic_id`|INT|PK|
|`mb_id`|INT|회원 관리 테이블의 PK|
|`group_id`|INT|그룹 아이디 PK|
|`status`|VARCHAR|그룹 상태값|
|`ic_number`|VARCHAR|초대 코드값|
|`ic_regdate`|DATETIME|초대코드 생성일|


### 6. code_car 테이블 구조
|컬럼명|컬럼타입|설명|
|------|---|---|
|`cc_id`|INT|PK|
|`ic_number`|VARCHAR|초대 코드 값|
|`cr_id`|INT|차량등록 테이블(car_registeration table)의 PK|
|`group_id`|INT|그룹 아이디|
|`status`|VARCHAR|그룹 상태값|
|`member`|INT|초대코드 등록한 회원|
|`cc_regdate`|DATETIME|초대코드 받아서 등록한 날짜|


### 7. car_registeration 테이블 구조
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


### 8. vehicle_status 테이블 구조
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
