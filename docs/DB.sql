--
-- PostgreSQL database dump
--

-- Dumped from database version 14.10 (Ubuntu 14.10-0ubuntu0.22.04.1)
-- Dumped by pg_dump version 14.10 (Ubuntu 14.10-0ubuntu0.22.04.1)

-- Started on 2024-02-28 13:54:37 -04

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 209 (class 1259 OID 17667)
-- Name: account_types; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.account_types (
    id bigint NOT NULL,
    denomination character varying(191) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.account_types OWNER TO postgres;

--
-- TOC entry 210 (class 1259 OID 17670)
-- Name: account_types_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.account_types_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.account_types_id_seq OWNER TO postgres;

--
-- TOC entry 4333 (class 0 OID 0)
-- Dependencies: 210
-- Name: account_types_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.account_types_id_seq OWNED BY public.account_types.id;


--
-- TOC entry 211 (class 1259 OID 17671)
-- Name: accounting_accounts; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.accounting_accounts (
    id bigint NOT NULL,
    name character varying(191) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.accounting_accounts OWNER TO postgres;

--
-- TOC entry 212 (class 1259 OID 17674)
-- Name: accounting_accounts_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.accounting_accounts_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.accounting_accounts_id_seq OWNER TO postgres;

--
-- TOC entry 4334 (class 0 OID 0)
-- Dependencies: 212
-- Name: accounting_accounts_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.accounting_accounts_id_seq OWNED BY public.accounting_accounts.id;


--
-- TOC entry 213 (class 1259 OID 17675)
-- Name: accounts; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.accounts (
    id bigint NOT NULL,
    name character varying(191) NOT NULL,
    account_num character varying(191) NOT NULL,
    description character varying(191) NOT NULL,
    account_type_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE public.accounts OWNER TO postgres;

--
-- TOC entry 214 (class 1259 OID 17680)
-- Name: accounts_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.accounts_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.accounts_id_seq OWNER TO postgres;

--
-- TOC entry 4335 (class 0 OID 0)
-- Dependencies: 214
-- Name: accounts_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.accounts_id_seq OWNED BY public.accounts.id;


--
-- TOC entry 215 (class 1259 OID 17681)
-- Name: activity_classifications; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.activity_classifications (
    id bigint NOT NULL,
    code character varying(191) NOT NULL,
    name character varying(300) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE public.activity_classifications OWNER TO postgres;

--
-- TOC entry 216 (class 1259 OID 17684)
-- Name: activity_classifications_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.activity_classifications_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.activity_classifications_id_seq OWNER TO postgres;

--
-- TOC entry 4336 (class 0 OID 0)
-- Dependencies: 216
-- Name: activity_classifications_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.activity_classifications_id_seq OWNED BY public.activity_classifications.id;


--
-- TOC entry 217 (class 1259 OID 17685)
-- Name: affidavit_fine; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.affidavit_fine (
    id bigint NOT NULL,
    fine_id bigint NOT NULL,
    affidavit_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.affidavit_fine OWNER TO postgres;

--
-- TOC entry 218 (class 1259 OID 17688)
-- Name: affidavit_fine_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.affidavit_fine_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.affidavit_fine_id_seq OWNER TO postgres;

--
-- TOC entry 4337 (class 0 OID 0)
-- Dependencies: 218
-- Name: affidavit_fine_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.affidavit_fine_id_seq OWNED BY public.affidavit_fine.id;


--
-- TOC entry 219 (class 1259 OID 17689)
-- Name: affidavits; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.affidavits (
    id bigint NOT NULL,
    amount numeric(15,2) NOT NULL,
    taxpayer_id bigint NOT NULL,
    month_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    user_id bigint NOT NULL,
    processed_at timestamp without time zone,
    total_brute_amount numeric(25,2) DEFAULT 0.00,
    num character varying(8)
);


ALTER TABLE public.affidavits OWNER TO postgres;

--
-- TOC entry 220 (class 1259 OID 17693)
-- Name: annexed_liqueurs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.annexed_liqueurs (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.annexed_liqueurs OWNER TO postgres;

--
-- TOC entry 221 (class 1259 OID 17696)
-- Name: annexed_liqueurs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.annexed_liqueurs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.annexed_liqueurs_id_seq OWNER TO postgres;

--
-- TOC entry 4338 (class 0 OID 0)
-- Dependencies: 221
-- Name: annexed_liqueurs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.annexed_liqueurs_id_seq OWNED BY public.annexed_liqueurs.id;


--
-- TOC entry 222 (class 1259 OID 17697)
-- Name: applications; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.applications (
    id bigint NOT NULL,
    amount numeric(15,2) NOT NULL,
    active boolean DEFAULT false NOT NULL,
    taxpayer_id bigint NOT NULL,
    concept_id bigint NOT NULL,
    user_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    total integer DEFAULT 1,
    num character varying(8)
);


ALTER TABLE public.applications OWNER TO postgres;

--
-- TOC entry 223 (class 1259 OID 17702)
-- Name: applications_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.applications_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.applications_id_seq OWNER TO postgres;

--
-- TOC entry 4339 (class 0 OID 0)
-- Dependencies: 223
-- Name: applications_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.applications_id_seq OWNED BY public.applications.id;


--
-- TOC entry 224 (class 1259 OID 17703)
-- Name: audits; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.audits (
    id bigint NOT NULL,
    user_type character varying(191),
    user_id bigint,
    event character varying(191) NOT NULL,
    auditable_type character varying(191) NOT NULL,
    auditable_id bigint NOT NULL,
    old_values text,
    new_values text,
    url text,
    ip_address inet,
    user_agent character varying(1023),
    tags character varying(191),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.audits OWNER TO postgres;

--
-- TOC entry 225 (class 1259 OID 17708)
-- Name: audits_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.audits_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.audits_id_seq OWNER TO postgres;

--
-- TOC entry 4340 (class 0 OID 0)
-- Dependencies: 225
-- Name: audits_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.audits_id_seq OWNED BY public.audits.id;


--
-- TOC entry 226 (class 1259 OID 17709)
-- Name: cancellation_types; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cancellation_types (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.cancellation_types OWNER TO postgres;

--
-- TOC entry 227 (class 1259 OID 17712)
-- Name: cancellation_types_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.cancellation_types_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cancellation_types_id_seq OWNER TO postgres;

--
-- TOC entry 4341 (class 0 OID 0)
-- Dependencies: 227
-- Name: cancellation_types_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.cancellation_types_id_seq OWNED BY public.cancellation_types.id;


--
-- TOC entry 228 (class 1259 OID 17713)
-- Name: cancellations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cancellations (
    id bigint NOT NULL,
    reason character varying(255) NOT NULL,
    cancellable_type character varying(255) NOT NULL,
    cancellable_id bigint NOT NULL,
    user_id bigint NOT NULL,
    cancellation_type_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE public.cancellations OWNER TO postgres;

--
-- TOC entry 229 (class 1259 OID 17718)
-- Name: cancellations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.cancellations_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cancellations_id_seq OWNER TO postgres;

--
-- TOC entry 4342 (class 0 OID 0)
-- Dependencies: 229
-- Name: cancellations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.cancellations_id_seq OWNED BY public.cancellations.id;


--
-- TOC entry 230 (class 1259 OID 17719)
-- Name: charging_methods; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.charging_methods (
    id bigint NOT NULL,
    name character varying(191) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.charging_methods OWNER TO postgres;

--
-- TOC entry 231 (class 1259 OID 17722)
-- Name: charging_methods_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.charging_methods_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.charging_methods_id_seq OWNER TO postgres;

--
-- TOC entry 4343 (class 0 OID 0)
-- Dependencies: 231
-- Name: charging_methods_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.charging_methods_id_seq OWNED BY public.charging_methods.id;


--
-- TOC entry 232 (class 1259 OID 17723)
-- Name: citizenships; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.citizenships (
    id bigint NOT NULL,
    description character varying(191) NOT NULL,
    correlative character varying(191) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.citizenships OWNER TO postgres;

--
-- TOC entry 233 (class 1259 OID 17726)
-- Name: citizenships_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.citizenships_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.citizenships_id_seq OWNER TO postgres;

--
-- TOC entry 4344 (class 0 OID 0)
-- Dependencies: 233
-- Name: citizenships_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.citizenships_id_seq OWNED BY public.citizenships.id;


--
-- TOC entry 234 (class 1259 OID 17727)
-- Name: commercial_denominations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.commercial_denominations (
    id bigint NOT NULL,
    name character varying(191) NOT NULL,
    taxpayer_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE public.commercial_denominations OWNER TO postgres;

--
-- TOC entry 235 (class 1259 OID 17730)
-- Name: commercial_denominations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.commercial_denominations_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.commercial_denominations_id_seq OWNER TO postgres;

--
-- TOC entry 4345 (class 0 OID 0)
-- Dependencies: 235
-- Name: commercial_denominations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.commercial_denominations_id_seq OWNED BY public.commercial_denominations.id;


--
-- TOC entry 236 (class 1259 OID 17731)
-- Name: commercial_registers; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.commercial_registers (
    id bigint NOT NULL,
    num character varying(191) NOT NULL,
    volume character varying(191) NOT NULL,
    case_file character varying(191) NOT NULL,
    start_date date NOT NULL,
    taxpayer_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE public.commercial_registers OWNER TO postgres;

--
-- TOC entry 237 (class 1259 OID 17736)
-- Name: commercial_registers_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.commercial_registers_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.commercial_registers_id_seq OWNER TO postgres;

--
-- TOC entry 4346 (class 0 OID 0)
-- Dependencies: 237
-- Name: commercial_registers_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.commercial_registers_id_seq OWNED BY public.commercial_registers.id;


--
-- TOC entry 238 (class 1259 OID 17737)
-- Name: communities; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.communities (
    id bigint NOT NULL,
    name character varying(191) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.communities OWNER TO postgres;

--
-- TOC entry 239 (class 1259 OID 17740)
-- Name: communities_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.communities_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.communities_id_seq OWNER TO postgres;

--
-- TOC entry 4347 (class 0 OID 0)
-- Dependencies: 239
-- Name: communities_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.communities_id_seq OWNED BY public.communities.id;


--
-- TOC entry 240 (class 1259 OID 17741)
-- Name: community_parish; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.community_parish (
    id bigint NOT NULL,
    community_id bigint NOT NULL,
    parish_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.community_parish OWNER TO postgres;

--
-- TOC entry 241 (class 1259 OID 17744)
-- Name: community_parish_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.community_parish_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.community_parish_id_seq OWNER TO postgres;

--
-- TOC entry 4348 (class 0 OID 0)
-- Dependencies: 241
-- Name: community_parish_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.community_parish_id_seq OWNED BY public.community_parish.id;


--
-- TOC entry 242 (class 1259 OID 17745)
-- Name: concepts; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.concepts (
    id bigint NOT NULL,
    code character varying(20) NOT NULL,
    name character varying(500) NOT NULL,
    observations character varying(191),
    ordinance_id bigint NOT NULL,
    liquidation_type_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    amount double precision,
    charging_method_id bigint,
    accounting_account_id bigint,
    own_income boolean DEFAULT false
);


ALTER TABLE public.concepts OWNER TO postgres;

--
-- TOC entry 243 (class 1259 OID 17751)
-- Name: concepts_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.concepts_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.concepts_id_seq OWNER TO postgres;

--
-- TOC entry 4349 (class 0 OID 0)
-- Dependencies: 243
-- Name: concepts_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.concepts_id_seq OWNED BY public.concepts.id;


--
-- TOC entry 244 (class 1259 OID 17752)
-- Name: correlative_numbers; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.correlative_numbers (
    id bigint NOT NULL,
    num character varying(191) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE public.correlative_numbers OWNER TO postgres;

--
-- TOC entry 245 (class 1259 OID 17755)
-- Name: correlative_numbers_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.correlative_numbers_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.correlative_numbers_id_seq OWNER TO postgres;

--
-- TOC entry 4350 (class 0 OID 0)
-- Dependencies: 245
-- Name: correlative_numbers_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.correlative_numbers_id_seq OWNED BY public.correlative_numbers.id;


--
-- TOC entry 246 (class 1259 OID 17756)
-- Name: correlative_types; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.correlative_types (
    id bigint NOT NULL,
    description character varying(191) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.correlative_types OWNER TO postgres;

--
-- TOC entry 247 (class 1259 OID 17759)
-- Name: correlative_types_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.correlative_types_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.correlative_types_id_seq OWNER TO postgres;

--
-- TOC entry 4351 (class 0 OID 0)
-- Dependencies: 247
-- Name: correlative_types_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.correlative_types_id_seq OWNED BY public.correlative_types.id;


--
-- TOC entry 248 (class 1259 OID 17760)
-- Name: correlatives; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.correlatives (
    id bigint NOT NULL,
    correlative_number_id bigint NOT NULL,
    correlative_type_id bigint NOT NULL,
    year_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE public.correlatives OWNER TO postgres;

--
-- TOC entry 249 (class 1259 OID 17763)
-- Name: correlatives_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.correlatives_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.correlatives_id_seq OWNER TO postgres;

--
-- TOC entry 4352 (class 0 OID 0)
-- Dependencies: 249
-- Name: correlatives_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.correlatives_id_seq OWNED BY public.correlatives.id;


--
-- TOC entry 250 (class 1259 OID 17764)
-- Name: credits; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.credits (
    id bigint NOT NULL,
    num character varying(255) NOT NULL,
    amount double precision NOT NULL,
    taxpayer_id bigint NOT NULL,
    payment_id bigint,
    generated_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    liquidation_id integer
);


ALTER TABLE public.credits OWNER TO postgres;

--
-- TOC entry 251 (class 1259 OID 17767)
-- Name: credits_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.credits_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.credits_id_seq OWNER TO postgres;

--
-- TOC entry 4353 (class 0 OID 0)
-- Dependencies: 251
-- Name: credits_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.credits_id_seq OWNED BY public.credits.id;


--
-- TOC entry 252 (class 1259 OID 17768)
-- Name: deductions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.deductions (
    id bigint NOT NULL,
    amount numeric(15,2) NOT NULL,
    user_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    liquidation_id integer,
    payment_id integer
);


ALTER TABLE public.deductions OWNER TO postgres;

--
-- TOC entry 253 (class 1259 OID 17771)
-- Name: dismissals; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.dismissals (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    taxpayer_id bigint NOT NULL,
    license_id bigint NOT NULL,
    dismissed_at timestamp(0) without time zone NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.dismissals OWNER TO postgres;

--
-- TOC entry 254 (class 1259 OID 17774)
-- Name: dismissals_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.dismissals_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.dismissals_id_seq OWNER TO postgres;

--
-- TOC entry 4354 (class 0 OID 0)
-- Dependencies: 254
-- Name: dismissals_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.dismissals_id_seq OWNED BY public.dismissals.id;


--
-- TOC entry 255 (class 1259 OID 17775)
-- Name: economic_activities; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.economic_activities (
    id bigint NOT NULL,
    code character varying(191) NOT NULL,
    name character varying(500) NOT NULL,
    aliquote character varying(191) NOT NULL,
    min_tax character varying(191) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    active boolean DEFAULT true,
    charging_method_id integer,
    old_min_tax character varying(255)
);


ALTER TABLE public.economic_activities OWNER TO postgres;

--
-- TOC entry 256 (class 1259 OID 17781)
-- Name: economic_activities_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.economic_activities_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.economic_activities_id_seq OWNER TO postgres;

--
-- TOC entry 4355 (class 0 OID 0)
-- Dependencies: 256
-- Name: economic_activities_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.economic_activities_id_seq OWNED BY public.economic_activities.id;


--
-- TOC entry 257 (class 1259 OID 17782)
-- Name: economic_activity_affidavit; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.economic_activity_affidavit (
    id bigint NOT NULL,
    amount numeric(15,2) NOT NULL,
    brute_amount numeric(15,2) NOT NULL,
    economic_activity_id bigint NOT NULL,
    affidavit_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE public.economic_activity_affidavit OWNER TO postgres;

--
-- TOC entry 258 (class 1259 OID 17785)
-- Name: economic_activity_license; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.economic_activity_license (
    id bigint NOT NULL,
    economic_activity_id bigint NOT NULL,
    license_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.economic_activity_license OWNER TO postgres;

--
-- TOC entry 259 (class 1259 OID 17788)
-- Name: economic_activity_license_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.economic_activity_license_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.economic_activity_license_id_seq OWNER TO postgres;

--
-- TOC entry 4356 (class 0 OID 0)
-- Dependencies: 259
-- Name: economic_activity_license_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.economic_activity_license_id_seq OWNED BY public.economic_activity_license.id;


--
-- TOC entry 260 (class 1259 OID 17789)
-- Name: economic_activity_settlement_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.economic_activity_settlement_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.economic_activity_settlement_id_seq OWNER TO postgres;

--
-- TOC entry 4357 (class 0 OID 0)
-- Dependencies: 260
-- Name: economic_activity_settlement_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.economic_activity_settlement_id_seq OWNED BY public.economic_activity_affidavit.id;


--
-- TOC entry 261 (class 1259 OID 17790)
-- Name: economic_activity_taxpayer; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.economic_activity_taxpayer (
    id bigint NOT NULL,
    economic_activity_id bigint NOT NULL,
    taxpayer_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.economic_activity_taxpayer OWNER TO postgres;

--
-- TOC entry 262 (class 1259 OID 17793)
-- Name: economic_activity_taxpayer_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.economic_activity_taxpayer_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.economic_activity_taxpayer_id_seq OWNER TO postgres;

--
-- TOC entry 4358 (class 0 OID 0)
-- Dependencies: 262
-- Name: economic_activity_taxpayer_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.economic_activity_taxpayer_id_seq OWNED BY public.economic_activity_taxpayer.id;


--
-- TOC entry 263 (class 1259 OID 17794)
-- Name: fines; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.fines (
    id bigint NOT NULL,
    amount numeric(15,2) NOT NULL,
    active boolean,
    taxpayer_id bigint NOT NULL,
    concept_id bigint NOT NULL,
    user_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    num character varying(8)
);


ALTER TABLE public.fines OWNER TO postgres;

--
-- TOC entry 264 (class 1259 OID 17797)
-- Name: fines_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.fines_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.fines_id_seq OWNER TO postgres;

--
-- TOC entry 4359 (class 0 OID 0)
-- Dependencies: 264
-- Name: fines_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.fines_id_seq OWNED BY public.fines.id;


--
-- TOC entry 265 (class 1259 OID 17798)
-- Name: leased_liqueurs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.leased_liqueurs (
    id bigint NOT NULL,
    liqueur_id bigint NOT NULL,
    leaser_id bigint NOT NULL,
    since date NOT NULL,
    until date NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE public.leased_liqueurs OWNER TO postgres;

--
-- TOC entry 266 (class 1259 OID 17801)
-- Name: leased_liqueurs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.leased_liqueurs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.leased_liqueurs_id_seq OWNER TO postgres;

--
-- TOC entry 4360 (class 0 OID 0)
-- Dependencies: 266
-- Name: leased_liqueurs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.leased_liqueurs_id_seq OWNED BY public.leased_liqueurs.id;


--
-- TOC entry 267 (class 1259 OID 17802)
-- Name: licenses; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.licenses (
    id bigint NOT NULL,
    emission_date date NOT NULL,
    correlative_id bigint NOT NULL,
    taxpayer_id bigint NOT NULL,
    ordinance_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    active boolean DEFAULT true NOT NULL,
    num character varying(191),
    downloaded_at timestamp(0) without time zone,
    expiration_date date,
    user_id bigint,
    representation_id bigint,
    liquidation_id integer
);


ALTER TABLE public.licenses OWNER TO postgres;

--
-- TOC entry 268 (class 1259 OID 17806)
-- Name: licenses_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.licenses_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.licenses_id_seq OWNER TO postgres;

--
-- TOC entry 4361 (class 0 OID 0)
-- Dependencies: 268
-- Name: licenses_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.licenses_id_seq OWNED BY public.licenses.id;


--
-- TOC entry 269 (class 1259 OID 17807)
-- Name: liqueur_annexes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.liqueur_annexes (
    id bigint NOT NULL,
    annex_id bigint NOT NULL,
    liqueur_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.liqueur_annexes OWNER TO postgres;

--
-- TOC entry 270 (class 1259 OID 17810)
-- Name: liqueur_annexes_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.liqueur_annexes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.liqueur_annexes_id_seq OWNER TO postgres;

--
-- TOC entry 4362 (class 0 OID 0)
-- Dependencies: 270
-- Name: liqueur_annexes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.liqueur_annexes_id_seq OWNED BY public.liqueur_annexes.id;


--
-- TOC entry 271 (class 1259 OID 17811)
-- Name: liqueur_classifications; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.liqueur_classifications (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    abbreviature character varying(255) NOT NULL,
    correlative character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.liqueur_classifications OWNER TO postgres;

--
-- TOC entry 272 (class 1259 OID 17816)
-- Name: liqueur_classifications_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.liqueur_classifications_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.liqueur_classifications_id_seq OWNER TO postgres;

--
-- TOC entry 4363 (class 0 OID 0)
-- Dependencies: 272
-- Name: liqueur_classifications_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.liqueur_classifications_id_seq OWNED BY public.liqueur_classifications.id;


--
-- TOC entry 273 (class 1259 OID 17817)
-- Name: liqueur_parameters; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.liqueur_parameters (
    id bigint NOT NULL,
    description character varying(255) NOT NULL,
    new_registry_amount double precision NOT NULL,
    renew_registry_amount double precision NOT NULL,
    authorization_registry_amount double precision NOT NULL,
    is_mobile boolean NOT NULL,
    liqueur_classification_id bigint,
    liqueur_zone_id bigint NOT NULL,
    charging_method_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.liqueur_parameters OWNER TO postgres;

--
-- TOC entry 274 (class 1259 OID 17820)
-- Name: liqueur_parameters_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.liqueur_parameters_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.liqueur_parameters_id_seq OWNER TO postgres;

--
-- TOC entry 4364 (class 0 OID 0)
-- Dependencies: 274
-- Name: liqueur_parameters_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.liqueur_parameters_id_seq OWNED BY public.liqueur_parameters.id;


--
-- TOC entry 275 (class 1259 OID 17821)
-- Name: liqueur_zones; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.liqueur_zones (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.liqueur_zones OWNER TO postgres;

--
-- TOC entry 276 (class 1259 OID 17824)
-- Name: liqueur_zones_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.liqueur_zones_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.liqueur_zones_id_seq OWNER TO postgres;

--
-- TOC entry 4365 (class 0 OID 0)
-- Dependencies: 276
-- Name: liqueur_zones_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.liqueur_zones_id_seq OWNED BY public.liqueur_zones.id;


--
-- TOC entry 277 (class 1259 OID 17825)
-- Name: liqueurs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.liqueurs (
    id bigint NOT NULL,
    num character varying(255),
    work_hours character varying(255),
    registry_date date NOT NULL,
    is_mobile boolean,
    liqueur_parameter_id bigint,
    liqueur_classification_id bigint,
    license_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    address character varying(255)
);


ALTER TABLE public.liqueurs OWNER TO postgres;

--
-- TOC entry 278 (class 1259 OID 17830)
-- Name: liqueurs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.liqueurs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.liqueurs_id_seq OWNER TO postgres;

--
-- TOC entry 4366 (class 0 OID 0)
-- Dependencies: 278
-- Name: liqueurs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.liqueurs_id_seq OWNED BY public.liqueurs.id;


--
-- TOC entry 280 (class 1259 OID 17834)
-- Name: liquidations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.liquidations (
    id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    num character varying(8),
    object_payment character varying(180),
    amount numeric(15,2),
    taxpayer_id integer,
    liquidable_type character varying(255),
    liquidable_id integer,
    concept_id integer,
    liquidation_type_id integer,
    status_id integer,
    user_id integer
);


ALTER TABLE public.liquidations OWNER TO postgres;

--
-- TOC entry 301 (class 1259 OID 17888)
-- Name: payment_liquidation; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.payment_liquidation (
    id integer NOT NULL,
    liquidation_id integer,
    payment_id integer,
    created_at timestamp with time zone,
    updated_at timestamp with time zone
);


ALTER TABLE public.payment_liquidation OWNER TO postgres;

--
-- TOC entry 307 (class 1259 OID 17900)
-- Name: payments; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.payments (
    id bigint NOT NULL,
    amount numeric(15,2) NOT NULL,
    payment_type_id bigint NOT NULL,
    payment_method_id bigint NOT NULL,
    status_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    observations character varying(140),
    num character varying(8),
    processed_at timestamp without time zone,
    taxpayer_id bigint,
    user_id bigint
);


ALTER TABLE public.payments OWNER TO postgres;

--
-- TOC entry 349 (class 1259 OID 18004)
-- Name: status; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.status (
    id bigint NOT NULL,
    name character varying(191) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.status OWNER TO postgres;

--
-- TOC entry 359 (class 1259 OID 18024)
-- Name: taxpayers; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.taxpayers (
    id bigint NOT NULL,
    rif character varying(191) NOT NULL,
    name character varying(191) NOT NULL,
    fiscal_address character varying(191) NOT NULL,
    phone character varying(191),
    email character varying(191),
    taxpayer_type_id bigint NOT NULL,
    community_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    taxpayer_classification_id bigint,
    dismissal_num character varying(255)
);


ALTER TABLE public.taxpayers OWNER TO postgres;

--
-- TOC entry 361 (class 1259 OID 18030)
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    identity_card character varying(191) NOT NULL,
    phone character varying(191),
    login character varying(191) NOT NULL,
    password character varying(191) NOT NULL,
    avatar character varying(191),
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    full_name character varying(255),
    active boolean DEFAULT true,
    deleted_at timestamp without time zone
);


ALTER TABLE public.users OWNER TO postgres;

--
-- TOC entry 366 (class 1259 OID 21483)
-- Name: liquidacionesporconceptodemulta; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.liquidacionesporconceptodemulta AS
 SELECT taxpayers.name AS "Contribuyente",
    concepts.name AS "Concepto",
    liquidations.amount AS "Cantidad",
    status.name AS "Estado",
    users.full_name AS "Usuario",
    liquidations.created_at,
    liquidations.updated_at
   FROM ((((((public.payment_liquidation
     JOIN public.liquidations ON ((payment_liquidation.liquidation_id = liquidations.id)))
     JOIN public.payments ON ((payment_liquidation.payment_id = payments.id)))
     JOIN public.taxpayers ON ((taxpayers.id = liquidations.taxpayer_id)))
     JOIN public.concepts ON ((concepts.id = liquidations.concept_id)))
     JOIN public.users ON ((payments.user_id = users.id)))
     JOIN public.status ON ((payments.status_id = status.id)))
  WHERE ((liquidations.liquidation_type_id = 2) AND (liquidations.deleted_at IS NULL) AND (concepts.ordinance_id <> 6))
  ORDER BY liquidations.created_at DESC
 LIMIT 1000;


ALTER TABLE public.liquidacionesporconceptodemulta OWNER TO postgres;

--
-- TOC entry 279 (class 1259 OID 17831)
-- Name: liquidation_types; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.liquidation_types (
    id bigint NOT NULL,
    name character varying(191) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.liquidation_types OWNER TO postgres;

--
-- TOC entry 281 (class 1259 OID 17837)
-- Name: lists_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.lists_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.lists_id_seq OWNER TO postgres;

--
-- TOC entry 4367 (class 0 OID 0)
-- Dependencies: 281
-- Name: lists_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.lists_id_seq OWNED BY public.liquidation_types.id;


--
-- TOC entry 282 (class 1259 OID 17838)
-- Name: migrations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(191) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO postgres;

--
-- TOC entry 283 (class 1259 OID 17841)
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.migrations_id_seq OWNER TO postgres;

--
-- TOC entry 4368 (class 0 OID 0)
-- Dependencies: 283
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- TOC entry 284 (class 1259 OID 17842)
-- Name: months; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.months (
    id bigint NOT NULL,
    name character varying(191) NOT NULL,
    year_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    start_period_at timestamp(0) without time zone
);


ALTER TABLE public.months OWNER TO postgres;

--
-- TOC entry 285 (class 1259 OID 17845)
-- Name: months_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.months_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.months_id_seq OWNER TO postgres;

--
-- TOC entry 4369 (class 0 OID 0)
-- Dependencies: 285
-- Name: months_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.months_id_seq OWNED BY public.months.id;


--
-- TOC entry 286 (class 1259 OID 17846)
-- Name: movements; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.movements (
    id integer NOT NULL,
    amount numeric(15,2),
    own_income boolean DEFAULT true,
    concurrent boolean DEFAULT true,
    liquidation_id integer,
    concept_id integer,
    payment_id integer,
    year_id integer,
    created_at timestamp with time zone,
    updated_at timestamp with time zone,
    deleted_at timestamp with time zone
);


ALTER TABLE public.movements OWNER TO postgres;

--
-- TOC entry 287 (class 1259 OID 17851)
-- Name: movements_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.movements_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.movements_id_seq OWNER TO postgres;

--
-- TOC entry 4370 (class 0 OID 0)
-- Dependencies: 287
-- Name: movements_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.movements_id_seq OWNED BY public.movements.id;


--
-- TOC entry 288 (class 1259 OID 17852)
-- Name: oauth_access_tokens; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.oauth_access_tokens (
    id character varying(100) NOT NULL,
    user_id bigint,
    client_id bigint NOT NULL,
    name character varying(191),
    scopes text,
    revoked boolean NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    expires_at timestamp(0) without time zone
);


ALTER TABLE public.oauth_access_tokens OWNER TO postgres;

--
-- TOC entry 289 (class 1259 OID 17857)
-- Name: oauth_auth_codes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.oauth_auth_codes (
    id character varying(100) NOT NULL,
    user_id bigint NOT NULL,
    client_id bigint NOT NULL,
    scopes text,
    revoked boolean NOT NULL,
    expires_at timestamp(0) without time zone
);


ALTER TABLE public.oauth_auth_codes OWNER TO postgres;

--
-- TOC entry 290 (class 1259 OID 17862)
-- Name: oauth_clients; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.oauth_clients (
    id bigint NOT NULL,
    user_id bigint,
    name character varying(191) NOT NULL,
    secret character varying(100),
    provider character varying(191),
    redirect text NOT NULL,
    personal_access_client boolean NOT NULL,
    password_client boolean NOT NULL,
    revoked boolean NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.oauth_clients OWNER TO postgres;

--
-- TOC entry 291 (class 1259 OID 17868)
-- Name: oauth_clients_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.oauth_clients_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.oauth_clients_id_seq OWNER TO postgres;

--
-- TOC entry 4371 (class 0 OID 0)
-- Dependencies: 291
-- Name: oauth_clients_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.oauth_clients_id_seq OWNED BY public.oauth_clients.id;


--
-- TOC entry 292 (class 1259 OID 17869)
-- Name: oauth_personal_access_clients; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.oauth_personal_access_clients (
    id bigint NOT NULL,
    client_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.oauth_personal_access_clients OWNER TO postgres;

--
-- TOC entry 293 (class 1259 OID 17872)
-- Name: oauth_personal_access_clients_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.oauth_personal_access_clients_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.oauth_personal_access_clients_id_seq OWNER TO postgres;

--
-- TOC entry 4372 (class 0 OID 0)
-- Dependencies: 293
-- Name: oauth_personal_access_clients_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.oauth_personal_access_clients_id_seq OWNED BY public.oauth_personal_access_clients.id;


--
-- TOC entry 294 (class 1259 OID 17873)
-- Name: oauth_refresh_tokens; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.oauth_refresh_tokens (
    id character varying(100) NOT NULL,
    access_token_id character varying(100) NOT NULL,
    revoked boolean NOT NULL,
    expires_at timestamp(0) without time zone
);


ALTER TABLE public.oauth_refresh_tokens OWNER TO postgres;

--
-- TOC entry 295 (class 1259 OID 17876)
-- Name: ordinances; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ordinances (
    id bigint NOT NULL,
    description character varying(191) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.ordinances OWNER TO postgres;

--
-- TOC entry 296 (class 1259 OID 17879)
-- Name: ordinances_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.ordinances_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ordinances_id_seq OWNER TO postgres;

--
-- TOC entry 4373 (class 0 OID 0)
-- Dependencies: 296
-- Name: ordinances_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.ordinances_id_seq OWNED BY public.ordinances.id;


--
-- TOC entry 297 (class 1259 OID 17880)
-- Name: ownership_states; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ownership_states (
    id bigint NOT NULL,
    description character varying(191) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.ownership_states OWNER TO postgres;

--
-- TOC entry 298 (class 1259 OID 17883)
-- Name: ownership_states_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.ownership_states_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ownership_states_id_seq OWNER TO postgres;

--
-- TOC entry 4374 (class 0 OID 0)
-- Dependencies: 298
-- Name: ownership_states_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.ownership_states_id_seq OWNED BY public.ownership_states.id;


--
-- TOC entry 299 (class 1259 OID 17884)
-- Name: parishes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.parishes (
    id bigint NOT NULL,
    name character varying(191) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.parishes OWNER TO postgres;

--
-- TOC entry 300 (class 1259 OID 17887)
-- Name: parishes_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.parishes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.parishes_id_seq OWNER TO postgres;

--
-- TOC entry 4375 (class 0 OID 0)
-- Dependencies: 300
-- Name: parishes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.parishes_id_seq OWNED BY public.parishes.id;


--
-- TOC entry 302 (class 1259 OID 17891)
-- Name: payment_liquidation_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.payment_liquidation_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.payment_liquidation_id_seq OWNER TO postgres;

--
-- TOC entry 4376 (class 0 OID 0)
-- Dependencies: 302
-- Name: payment_liquidation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.payment_liquidation_id_seq OWNED BY public.payment_liquidation.id;


--
-- TOC entry 303 (class 1259 OID 17892)
-- Name: payment_methods; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.payment_methods (
    id bigint NOT NULL,
    name character varying(191) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.payment_methods OWNER TO postgres;

--
-- TOC entry 304 (class 1259 OID 17895)
-- Name: payment_methods_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.payment_methods_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.payment_methods_id_seq OWNER TO postgres;

--
-- TOC entry 4377 (class 0 OID 0)
-- Dependencies: 304
-- Name: payment_methods_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.payment_methods_id_seq OWNED BY public.payment_methods.id;


--
-- TOC entry 305 (class 1259 OID 17896)
-- Name: payment_types; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.payment_types (
    id bigint NOT NULL,
    description character varying(191) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.payment_types OWNER TO postgres;

--
-- TOC entry 306 (class 1259 OID 17899)
-- Name: payment_types_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.payment_types_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.payment_types_id_seq OWNER TO postgres;

--
-- TOC entry 4378 (class 0 OID 0)
-- Dependencies: 306
-- Name: payment_types_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.payment_types_id_seq OWNED BY public.payment_types.id;


--
-- TOC entry 308 (class 1259 OID 17903)
-- Name: payments_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.payments_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.payments_id_seq OWNER TO postgres;

--
-- TOC entry 4379 (class 0 OID 0)
-- Dependencies: 308
-- Name: payments_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.payments_id_seq OWNED BY public.payments.id;


--
-- TOC entry 309 (class 1259 OID 17904)
-- Name: people; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.people (
    id bigint NOT NULL,
    document character varying(191) NOT NULL,
    first_name character varying(191) NOT NULL,
    second_name character varying(191),
    surname character varying(191) NOT NULL,
    second_surname character varying(191),
    address character varying(191),
    phone character varying(191),
    email character varying(191),
    citizenship_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE public.people OWNER TO postgres;

--
-- TOC entry 310 (class 1259 OID 17909)
-- Name: people_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.people_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.people_id_seq OWNER TO postgres;

--
-- TOC entry 4380 (class 0 OID 0)
-- Dependencies: 310
-- Name: people_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.people_id_seq OWNED BY public.people.id;


--
-- TOC entry 311 (class 1259 OID 17910)
-- Name: permission_role; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.permission_role (
    id bigint NOT NULL,
    permission_id bigint NOT NULL,
    role_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.permission_role OWNER TO postgres;

--
-- TOC entry 312 (class 1259 OID 17913)
-- Name: permission_role_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.permission_role_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.permission_role_id_seq OWNER TO postgres;

--
-- TOC entry 4381 (class 0 OID 0)
-- Dependencies: 312
-- Name: permission_role_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.permission_role_id_seq OWNED BY public.permission_role.id;


--
-- TOC entry 313 (class 1259 OID 17914)
-- Name: permission_user; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.permission_user (
    id bigint NOT NULL,
    permission_id bigint NOT NULL,
    user_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    model_type character varying(255)
);


ALTER TABLE public.permission_user OWNER TO postgres;

--
-- TOC entry 314 (class 1259 OID 17917)
-- Name: permission_user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.permission_user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.permission_user_id_seq OWNER TO postgres;

--
-- TOC entry 4382 (class 0 OID 0)
-- Dependencies: 314
-- Name: permission_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.permission_user_id_seq OWNED BY public.permission_user.id;


--
-- TOC entry 315 (class 1259 OID 17918)
-- Name: permissions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.permissions (
    id bigint NOT NULL,
    name character varying(191) NOT NULL,
    slug character varying(191) NOT NULL,
    description text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    guard_name character varying(255) DEFAULT 'web'::character varying
);


ALTER TABLE public.permissions OWNER TO postgres;

--
-- TOC entry 316 (class 1259 OID 17924)
-- Name: permissions_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.permissions_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.permissions_id_seq OWNER TO postgres;

--
-- TOC entry 4383 (class 0 OID 0)
-- Dependencies: 316
-- Name: permissions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.permissions_id_seq OWNED BY public.permissions.id;


--
-- TOC entry 317 (class 1259 OID 17925)
-- Name: permits; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.permits (
    id bigint NOT NULL,
    amount double precision NOT NULL,
    active boolean NOT NULL,
    valid_until date NOT NULL,
    concept_id bigint NOT NULL,
    user_id bigint NOT NULL,
    taxpayer_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE public.permits OWNER TO postgres;

--
-- TOC entry 318 (class 1259 OID 17928)
-- Name: permits_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.permits_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.permits_id_seq OWNER TO postgres;

--
-- TOC entry 4384 (class 0 OID 0)
-- Dependencies: 318
-- Name: permits_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.permits_id_seq OWNED BY public.permits.id;


--
-- TOC entry 319 (class 1259 OID 17929)
-- Name: personal_access_tokens; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.personal_access_tokens (
    id bigint NOT NULL,
    tokenable_type character varying(255) NOT NULL,
    tokenable_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    token character varying(64) NOT NULL,
    abilities text,
    last_used_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.personal_access_tokens OWNER TO postgres;

--
-- TOC entry 320 (class 1259 OID 17934)
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.personal_access_tokens_id_seq OWNER TO postgres;

--
-- TOC entry 4385 (class 0 OID 0)
-- Dependencies: 320
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.personal_access_tokens_id_seq OWNED BY public.personal_access_tokens.id;


--
-- TOC entry 321 (class 1259 OID 17935)
-- Name: petro_prices; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.petro_prices (
    id bigint NOT NULL,
    value numeric(21,2),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.petro_prices OWNER TO postgres;

--
-- TOC entry 322 (class 1259 OID 17938)
-- Name: petro_prices_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.petro_prices_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.petro_prices_id_seq OWNER TO postgres;

--
-- TOC entry 4386 (class 0 OID 0)
-- Dependencies: 322
-- Name: petro_prices_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.petro_prices_id_seq OWNED BY public.petro_prices.id;


--
-- TOC entry 323 (class 1259 OID 17939)
-- Name: properties; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.properties (
    id bigint NOT NULL,
    local character varying(191) NOT NULL,
    street character varying(191) NOT NULL,
    floor character varying(191) NOT NULL,
    cadastre_num character varying(191) NOT NULL,
    bulletin character varying(191) NOT NULL,
    land_valuation character varying(191) NOT NULL,
    square_meters character varying(191) NOT NULL,
    property_type_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE public.properties OWNER TO postgres;

--
-- TOC entry 324 (class 1259 OID 17944)
-- Name: properties_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.properties_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.properties_id_seq OWNER TO postgres;

--
-- TOC entry 4387 (class 0 OID 0)
-- Dependencies: 324
-- Name: properties_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.properties_id_seq OWNED BY public.properties.id;


--
-- TOC entry 325 (class 1259 OID 17945)
-- Name: property_types; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.property_types (
    id bigint NOT NULL,
    classification character varying(191) NOT NULL,
    denomination character varying(191) NOT NULL,
    amount character varying(191) NOT NULL,
    charging_method_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.property_types OWNER TO postgres;

--
-- TOC entry 326 (class 1259 OID 17950)
-- Name: property_types_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.property_types_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.property_types_id_seq OWNER TO postgres;

--
-- TOC entry 4388 (class 0 OID 0)
-- Dependencies: 326
-- Name: property_types_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.property_types_id_seq OWNED BY public.property_types.id;


--
-- TOC entry 327 (class 1259 OID 17951)
-- Name: receivables_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.receivables_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.receivables_id_seq OWNER TO postgres;

--
-- TOC entry 4389 (class 0 OID 0)
-- Dependencies: 327
-- Name: receivables_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.receivables_id_seq OWNED BY public.liquidations.id;


--
-- TOC entry 328 (class 1259 OID 17952)
-- Name: reductions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.reductions (
    id bigint NOT NULL,
    code character varying(191) NOT NULL,
    description character varying(191) NOT NULL,
    percentage double precision NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE public.reductions OWNER TO postgres;

--
-- TOC entry 329 (class 1259 OID 17955)
-- Name: reductions_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.reductions_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.reductions_id_seq OWNER TO postgres;

--
-- TOC entry 4390 (class 0 OID 0)
-- Dependencies: 329
-- Name: reductions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.reductions_id_seq OWNED BY public.reductions.id;


--
-- TOC entry 330 (class 1259 OID 17956)
-- Name: references; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."references" (
    id bigint NOT NULL,
    reference character varying(191) NOT NULL,
    account_id bigint NOT NULL,
    payment_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE public."references" OWNER TO postgres;

--
-- TOC entry 331 (class 1259 OID 17959)
-- Name: references_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.references_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.references_id_seq OWNER TO postgres;

--
-- TOC entry 4391 (class 0 OID 0)
-- Dependencies: 331
-- Name: references_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.references_id_seq OWNED BY public."references".id;


--
-- TOC entry 368 (class 1259 OID 46085)
-- Name: reportefacturadiaria; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.reportefacturadiaria AS
 SELECT payments.id,
    payments.num,
    taxpayers.name,
    payments.amount,
    payments.payment_type_id,
    payments.payment_method_id,
    payments.status_id,
    payments.created_at,
    payments.updated_at,
    payments.deleted_at,
    payments.observations,
    payments.processed_at,
    payments.taxpayer_id,
    payments.user_id
   FROM (public.payments
     JOIN public.taxpayers ON ((taxpayers.id = payments.taxpayer_id)))
  WHERE ((payments.deleted_at IS NULL) AND (payments.created_at < (now())::date) AND (((( SELECT count(payments_1.id) AS count
           FROM public.payments payments_1
          WHERE ((payments_1.created_at >= (((now())::date - '1 day'::interval))::date) AND (payments_1.created_at < (now())::date))) > 0) AND (payments.created_at >= (((now())::date - '1 day'::interval))::date)) OR ((EXTRACT(isodow FROM (now())::date) = (1)::numeric) AND (( SELECT count(payments_1.id) AS count
           FROM public.payments payments_1
          WHERE ((payments_1.created_at >= (((now())::date - '3 days'::interval))::date) AND (payments_1.created_at <= (now())::date))) > 0) AND (payments.created_at >= (((now())::date - '3 days'::interval))::date)) OR ((( SELECT count(payments_1.id) AS count
           FROM public.payments payments_1
          WHERE ((payments_1.created_at >= (((now())::date - '2 days'::interval))::date) AND (payments_1.created_at <= (now())::date))) > 0) AND (( SELECT count(payments_1.id) AS count
           FROM public.payments payments_1
          WHERE ((payments_1.created_at >= (((now())::date - '1 day'::interval))::date) AND (payments_1.created_at < (now())::date))) = 0) AND (payments.created_at >= (((now())::date - '2 days'::interval))::date)) OR ((EXTRACT(isodow FROM (now())::date) = (2)::numeric) AND (( SELECT count(payments_1.id) AS count
           FROM public.payments payments_1
          WHERE ((payments_1.created_at >= (((now())::date - '1 day'::interval))::date) AND (payments_1.created_at < (now())::date))) = 0) AND (( SELECT count(payments_1.id) AS count
           FROM public.payments payments_1
          WHERE ((payments_1.created_at >= (((now())::date - '4 days'::interval))::date) AND (payments_1.created_at <= (now())::date))) > 0) AND (payments.created_at >= (((now())::date - '4 days'::interval))::date)) OR ((EXTRACT(isodow FROM (now())::date) = (1)::numeric) AND (( SELECT count(payments_1.id) AS count
           FROM public.payments payments_1
          WHERE ((payments_1.created_at >= (((now())::date - '3 days'::interval))::date) AND (payments_1.created_at < (now())::date))) = 0) AND (( SELECT count(payments_1.id) AS count
           FROM public.payments payments_1
          WHERE ((payments_1.created_at >= (((now())::date - '4 days'::interval))::date) AND (payments_1.created_at <= (now())::date))) > 0) AND (payments.created_at >= (((now())::date - '4 days'::interval))::date))))
  ORDER BY payments.id;


ALTER TABLE public.reportefacturadiaria OWNER TO postgres;

--
-- TOC entry 332 (class 1259 OID 17960)
-- Name: representation_types; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.representation_types (
    id bigint NOT NULL,
    name character varying(191) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.representation_types OWNER TO postgres;

--
-- TOC entry 333 (class 1259 OID 17963)
-- Name: representation_types_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.representation_types_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.representation_types_id_seq OWNER TO postgres;

--
-- TOC entry 4392 (class 0 OID 0)
-- Dependencies: 333
-- Name: representation_types_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.representation_types_id_seq OWNED BY public.representation_types.id;


--
-- TOC entry 334 (class 1259 OID 17964)
-- Name: representations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.representations (
    id bigint NOT NULL,
    taxpayer_id bigint NOT NULL,
    person_id bigint NOT NULL,
    representation_type_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.representations OWNER TO postgres;

--
-- TOC entry 335 (class 1259 OID 17967)
-- Name: representations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.representations_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.representations_id_seq OWNER TO postgres;

--
-- TOC entry 4393 (class 0 OID 0)
-- Dependencies: 335
-- Name: representations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.representations_id_seq OWNED BY public.representations.id;


--
-- TOC entry 336 (class 1259 OID 17968)
-- Name: requirement_taxpayer; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.requirement_taxpayer (
    id bigint NOT NULL,
    requirement_id bigint NOT NULL,
    taxpayer_id bigint NOT NULL,
    liquidation_id bigint NOT NULL,
    active boolean NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.requirement_taxpayer OWNER TO postgres;

--
-- TOC entry 337 (class 1259 OID 17971)
-- Name: requirement_taxpayer_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.requirement_taxpayer_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.requirement_taxpayer_id_seq OWNER TO postgres;

--
-- TOC entry 4394 (class 0 OID 0)
-- Dependencies: 337
-- Name: requirement_taxpayer_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.requirement_taxpayer_id_seq OWNED BY public.requirement_taxpayer.id;


--
-- TOC entry 338 (class 1259 OID 17972)
-- Name: requirements; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.requirements (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    num character varying(255) NOT NULL,
    concept_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.requirements OWNER TO postgres;

--
-- TOC entry 339 (class 1259 OID 17977)
-- Name: requirements_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.requirements_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.requirements_id_seq OWNER TO postgres;

--
-- TOC entry 4395 (class 0 OID 0)
-- Dependencies: 339
-- Name: requirements_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.requirements_id_seq OWNED BY public.requirements.id;


--
-- TOC entry 340 (class 1259 OID 17978)
-- Name: revenue_stamps; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.revenue_stamps (
    id bigint NOT NULL,
    date date NOT NULL,
    payment_num character varying(255) NOT NULL,
    amount numeric(15,2) NOT NULL,
    observations character varying(255) NOT NULL,
    license_id bigint NOT NULL,
    user_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.revenue_stamps OWNER TO postgres;

--
-- TOC entry 341 (class 1259 OID 17983)
-- Name: revenue_stamps_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.revenue_stamps_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.revenue_stamps_id_seq OWNER TO postgres;

--
-- TOC entry 4396 (class 0 OID 0)
-- Dependencies: 341
-- Name: revenue_stamps_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.revenue_stamps_id_seq OWNED BY public.revenue_stamps.id;


--
-- TOC entry 342 (class 1259 OID 17984)
-- Name: role_user; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.role_user (
    id bigint NOT NULL,
    role_id bigint NOT NULL,
    user_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    model_type character varying(255)
);


ALTER TABLE public.role_user OWNER TO postgres;

--
-- TOC entry 343 (class 1259 OID 17987)
-- Name: role_user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.role_user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.role_user_id_seq OWNER TO postgres;

--
-- TOC entry 4397 (class 0 OID 0)
-- Dependencies: 343
-- Name: role_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.role_user_id_seq OWNED BY public.role_user.id;


--
-- TOC entry 344 (class 1259 OID 17988)
-- Name: roles; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.roles (
    id bigint NOT NULL,
    name character varying(191) NOT NULL,
    slug character varying(191) NOT NULL,
    description text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    special character varying(255),
    guard_name character varying(255) DEFAULT 'web'::character varying,
    CONSTRAINT roles_special_check CHECK (((special)::text = ANY (ARRAY[('all-access'::character varying)::text, ('no-access'::character varying)::text])))
);


ALTER TABLE public.roles OWNER TO postgres;

--
-- TOC entry 345 (class 1259 OID 17995)
-- Name: roles_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.roles_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.roles_id_seq OWNER TO postgres;

--
-- TOC entry 4398 (class 0 OID 0)
-- Dependencies: 345
-- Name: roles_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.roles_id_seq OWNED BY public.roles.id;


--
-- TOC entry 346 (class 1259 OID 17996)
-- Name: settlements_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.settlements_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.settlements_id_seq OWNER TO postgres;

--
-- TOC entry 4399 (class 0 OID 0)
-- Dependencies: 346
-- Name: settlements_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.settlements_id_seq OWNED BY public.affidavits.id;


--
-- TOC entry 347 (class 1259 OID 17997)
-- Name: signatures; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.signatures (
    id bigint NOT NULL,
    title character varying(255) NOT NULL,
    decree character varying(255) NOT NULL,
    active character varying(255) DEFAULT '1'::character varying NOT NULL,
    user_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.signatures OWNER TO postgres;

--
-- TOC entry 348 (class 1259 OID 18003)
-- Name: signatures_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.signatures_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.signatures_id_seq OWNER TO postgres;

--
-- TOC entry 4400 (class 0 OID 0)
-- Dependencies: 348
-- Name: signatures_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.signatures_id_seq OWNED BY public.signatures.id;


--
-- TOC entry 350 (class 1259 OID 18007)
-- Name: status_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.status_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.status_id_seq OWNER TO postgres;

--
-- TOC entry 4401 (class 0 OID 0)
-- Dependencies: 350
-- Name: status_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.status_id_seq OWNED BY public.status.id;


--
-- TOC entry 351 (class 1259 OID 18008)
-- Name: tax_units; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tax_units (
    id bigint NOT NULL,
    law character varying(191) NOT NULL,
    value double precision NOT NULL,
    publication_date date NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.tax_units OWNER TO postgres;

--
-- TOC entry 352 (class 1259 OID 18011)
-- Name: tax_units_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tax_units_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tax_units_id_seq OWNER TO postgres;

--
-- TOC entry 4402 (class 0 OID 0)
-- Dependencies: 352
-- Name: tax_units_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tax_units_id_seq OWNED BY public.tax_units.id;


--
-- TOC entry 353 (class 1259 OID 18012)
-- Name: taxpayer_classifications; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.taxpayer_classifications (
    id bigint NOT NULL,
    name character varying(191) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.taxpayer_classifications OWNER TO postgres;

--
-- TOC entry 354 (class 1259 OID 18015)
-- Name: taxpayer_classifications_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.taxpayer_classifications_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.taxpayer_classifications_id_seq OWNER TO postgres;

--
-- TOC entry 4403 (class 0 OID 0)
-- Dependencies: 354
-- Name: taxpayer_classifications_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.taxpayer_classifications_id_seq OWNED BY public.taxpayer_classifications.id;


--
-- TOC entry 355 (class 1259 OID 18016)
-- Name: taxpayer_property; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.taxpayer_property (
    id bigint NOT NULL,
    document character varying(191) NOT NULL,
    property_id bigint NOT NULL,
    ownership_state_id bigint NOT NULL,
    taxpayer_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.taxpayer_property OWNER TO postgres;

--
-- TOC entry 356 (class 1259 OID 18019)
-- Name: taxpayer_property_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.taxpayer_property_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.taxpayer_property_id_seq OWNER TO postgres;

--
-- TOC entry 4404 (class 0 OID 0)
-- Dependencies: 356
-- Name: taxpayer_property_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.taxpayer_property_id_seq OWNED BY public.taxpayer_property.id;


--
-- TOC entry 357 (class 1259 OID 18020)
-- Name: taxpayer_types; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.taxpayer_types (
    id bigint NOT NULL,
    description character varying(191) NOT NULL,
    correlative character varying(191) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.taxpayer_types OWNER TO postgres;

--
-- TOC entry 358 (class 1259 OID 18023)
-- Name: taxpayer_types_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.taxpayer_types_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.taxpayer_types_id_seq OWNER TO postgres;

--
-- TOC entry 4405 (class 0 OID 0)
-- Dependencies: 358
-- Name: taxpayer_types_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.taxpayer_types_id_seq OWNED BY public.taxpayer_types.id;


--
-- TOC entry 360 (class 1259 OID 18029)
-- Name: taxpayers_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.taxpayers_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.taxpayers_id_seq OWNER TO postgres;

--
-- TOC entry 4406 (class 0 OID 0)
-- Dependencies: 360
-- Name: taxpayers_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.taxpayers_id_seq OWNED BY public.taxpayers.id;


--
-- TOC entry 367 (class 1259 OID 21488)
-- Name: taxpayerswithoutaffidavits; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.taxpayerswithoutaffidavits AS
 SELECT taxpayers.id,
    taxpayers.name AS "Contribuyente",
    concat(taxpayer_types.correlative, '-', taxpayers.rif) AS "Rif",
    taxpayers.fiscal_address AS "Dirección",
    taxpayers.created_at
   FROM (public.taxpayers
     JOIN public.taxpayer_types ON ((taxpayers.taxpayer_type_id = taxpayer_types.id)))
  WHERE ((NOT (taxpayers.id IN ( SELECT affidavits.taxpayer_id
           FROM public.affidavits))) AND (taxpayers.deleted_at IS NULL) AND (taxpayers.id IN ( SELECT liquidations.taxpayer_id
           FROM public.liquidations
          WHERE ((liquidations.object_payment)::text <> ALL ((ARRAY['LIQUIDACIÓN SOBRE LA ACTIVIDAD ECONÓMICA'::character varying, 'LIQUIDACIÓN SOBRE LA ACTIVIDAD ECONÓMICA%'::character varying])::text[])))) AND (taxpayers.taxpayer_type_id = 1));


ALTER TABLE public.taxpayerswithoutaffidavits OWNER TO postgres;

--
-- TOC entry 362 (class 1259 OID 18036)
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO postgres;

--
-- TOC entry 4407 (class 0 OID 0)
-- Dependencies: 362
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- TOC entry 363 (class 1259 OID 18037)
-- Name: withholdings_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.withholdings_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.withholdings_id_seq OWNER TO postgres;

--
-- TOC entry 4408 (class 0 OID 0)
-- Dependencies: 363
-- Name: withholdings_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.withholdings_id_seq OWNED BY public.deductions.id;


--
-- TOC entry 364 (class 1259 OID 18038)
-- Name: years; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.years (
    id bigint NOT NULL,
    year character varying(191) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.years OWNER TO postgres;

--
-- TOC entry 365 (class 1259 OID 18041)
-- Name: years_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.years_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.years_id_seq OWNER TO postgres;

--
-- TOC entry 4409 (class 0 OID 0)
-- Dependencies: 365
-- Name: years_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.years_id_seq OWNED BY public.years.id;


--
-- TOC entry 3651 (class 2604 OID 18042)
-- Name: account_types id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.account_types ALTER COLUMN id SET DEFAULT nextval('public.account_types_id_seq'::regclass);


--
-- TOC entry 3652 (class 2604 OID 18043)
-- Name: accounting_accounts id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.accounting_accounts ALTER COLUMN id SET DEFAULT nextval('public.accounting_accounts_id_seq'::regclass);


--
-- TOC entry 3653 (class 2604 OID 18044)
-- Name: accounts id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.accounts ALTER COLUMN id SET DEFAULT nextval('public.accounts_id_seq'::regclass);


--
-- TOC entry 3654 (class 2604 OID 18045)
-- Name: activity_classifications id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.activity_classifications ALTER COLUMN id SET DEFAULT nextval('public.activity_classifications_id_seq'::regclass);


--
-- TOC entry 3655 (class 2604 OID 18046)
-- Name: affidavit_fine id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.affidavit_fine ALTER COLUMN id SET DEFAULT nextval('public.affidavit_fine_id_seq'::regclass);


--
-- TOC entry 3657 (class 2604 OID 18047)
-- Name: affidavits id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.affidavits ALTER COLUMN id SET DEFAULT nextval('public.settlements_id_seq'::regclass);


--
-- TOC entry 3658 (class 2604 OID 18048)
-- Name: annexed_liqueurs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.annexed_liqueurs ALTER COLUMN id SET DEFAULT nextval('public.annexed_liqueurs_id_seq'::regclass);


--
-- TOC entry 3661 (class 2604 OID 18049)
-- Name: applications id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.applications ALTER COLUMN id SET DEFAULT nextval('public.applications_id_seq'::regclass);


--
-- TOC entry 3662 (class 2604 OID 18050)
-- Name: audits id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.audits ALTER COLUMN id SET DEFAULT nextval('public.audits_id_seq'::regclass);


--
-- TOC entry 3663 (class 2604 OID 18051)
-- Name: cancellation_types id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cancellation_types ALTER COLUMN id SET DEFAULT nextval('public.cancellation_types_id_seq'::regclass);


--
-- TOC entry 3664 (class 2604 OID 18052)
-- Name: cancellations id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cancellations ALTER COLUMN id SET DEFAULT nextval('public.cancellations_id_seq'::regclass);


--
-- TOC entry 3665 (class 2604 OID 18053)
-- Name: charging_methods id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.charging_methods ALTER COLUMN id SET DEFAULT nextval('public.charging_methods_id_seq'::regclass);


--
-- TOC entry 3666 (class 2604 OID 18054)
-- Name: citizenships id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.citizenships ALTER COLUMN id SET DEFAULT nextval('public.citizenships_id_seq'::regclass);


--
-- TOC entry 3667 (class 2604 OID 18055)
-- Name: commercial_denominations id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commercial_denominations ALTER COLUMN id SET DEFAULT nextval('public.commercial_denominations_id_seq'::regclass);


--
-- TOC entry 3668 (class 2604 OID 18056)
-- Name: commercial_registers id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commercial_registers ALTER COLUMN id SET DEFAULT nextval('public.commercial_registers_id_seq'::regclass);


--
-- TOC entry 3669 (class 2604 OID 18057)
-- Name: communities id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.communities ALTER COLUMN id SET DEFAULT nextval('public.communities_id_seq'::regclass);


--
-- TOC entry 3670 (class 2604 OID 18058)
-- Name: community_parish id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.community_parish ALTER COLUMN id SET DEFAULT nextval('public.community_parish_id_seq'::regclass);


--
-- TOC entry 3672 (class 2604 OID 18059)
-- Name: concepts id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.concepts ALTER COLUMN id SET DEFAULT nextval('public.concepts_id_seq'::regclass);


--
-- TOC entry 3673 (class 2604 OID 18060)
-- Name: correlative_numbers id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.correlative_numbers ALTER COLUMN id SET DEFAULT nextval('public.correlative_numbers_id_seq'::regclass);


--
-- TOC entry 3674 (class 2604 OID 18061)
-- Name: correlative_types id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.correlative_types ALTER COLUMN id SET DEFAULT nextval('public.correlative_types_id_seq'::regclass);


--
-- TOC entry 3675 (class 2604 OID 18062)
-- Name: correlatives id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.correlatives ALTER COLUMN id SET DEFAULT nextval('public.correlatives_id_seq'::regclass);


--
-- TOC entry 3676 (class 2604 OID 18063)
-- Name: credits id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.credits ALTER COLUMN id SET DEFAULT nextval('public.credits_id_seq'::regclass);


--
-- TOC entry 3677 (class 2604 OID 18064)
-- Name: deductions id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.deductions ALTER COLUMN id SET DEFAULT nextval('public.withholdings_id_seq'::regclass);


--
-- TOC entry 3678 (class 2604 OID 18065)
-- Name: dismissals id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dismissals ALTER COLUMN id SET DEFAULT nextval('public.dismissals_id_seq'::regclass);


--
-- TOC entry 3680 (class 2604 OID 18066)
-- Name: economic_activities id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.economic_activities ALTER COLUMN id SET DEFAULT nextval('public.economic_activities_id_seq'::regclass);


--
-- TOC entry 3681 (class 2604 OID 18067)
-- Name: economic_activity_affidavit id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.economic_activity_affidavit ALTER COLUMN id SET DEFAULT nextval('public.economic_activity_settlement_id_seq'::regclass);


--
-- TOC entry 3682 (class 2604 OID 18068)
-- Name: economic_activity_license id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.economic_activity_license ALTER COLUMN id SET DEFAULT nextval('public.economic_activity_license_id_seq'::regclass);


--
-- TOC entry 3683 (class 2604 OID 18069)
-- Name: economic_activity_taxpayer id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.economic_activity_taxpayer ALTER COLUMN id SET DEFAULT nextval('public.economic_activity_taxpayer_id_seq'::regclass);


--
-- TOC entry 3684 (class 2604 OID 18070)
-- Name: fines id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fines ALTER COLUMN id SET DEFAULT nextval('public.fines_id_seq'::regclass);


--
-- TOC entry 3685 (class 2604 OID 18071)
-- Name: leased_liqueurs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.leased_liqueurs ALTER COLUMN id SET DEFAULT nextval('public.leased_liqueurs_id_seq'::regclass);


--
-- TOC entry 3687 (class 2604 OID 18072)
-- Name: licenses id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.licenses ALTER COLUMN id SET DEFAULT nextval('public.licenses_id_seq'::regclass);


--
-- TOC entry 3688 (class 2604 OID 18073)
-- Name: liqueur_annexes id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.liqueur_annexes ALTER COLUMN id SET DEFAULT nextval('public.liqueur_annexes_id_seq'::regclass);


--
-- TOC entry 3689 (class 2604 OID 18074)
-- Name: liqueur_classifications id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.liqueur_classifications ALTER COLUMN id SET DEFAULT nextval('public.liqueur_classifications_id_seq'::regclass);


--
-- TOC entry 3690 (class 2604 OID 18075)
-- Name: liqueur_parameters id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.liqueur_parameters ALTER COLUMN id SET DEFAULT nextval('public.liqueur_parameters_id_seq'::regclass);


--
-- TOC entry 3691 (class 2604 OID 18076)
-- Name: liqueur_zones id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.liqueur_zones ALTER COLUMN id SET DEFAULT nextval('public.liqueur_zones_id_seq'::regclass);


--
-- TOC entry 3692 (class 2604 OID 18077)
-- Name: liqueurs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.liqueurs ALTER COLUMN id SET DEFAULT nextval('public.liqueurs_id_seq'::regclass);


--
-- TOC entry 3693 (class 2604 OID 18078)
-- Name: liquidation_types id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.liquidation_types ALTER COLUMN id SET DEFAULT nextval('public.lists_id_seq'::regclass);


--
-- TOC entry 3694 (class 2604 OID 18079)
-- Name: liquidations id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.liquidations ALTER COLUMN id SET DEFAULT nextval('public.receivables_id_seq'::regclass);


--
-- TOC entry 3695 (class 2604 OID 18080)
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- TOC entry 3696 (class 2604 OID 18081)
-- Name: months id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.months ALTER COLUMN id SET DEFAULT nextval('public.months_id_seq'::regclass);


--
-- TOC entry 3699 (class 2604 OID 18082)
-- Name: movements id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.movements ALTER COLUMN id SET DEFAULT nextval('public.movements_id_seq'::regclass);


--
-- TOC entry 3700 (class 2604 OID 18083)
-- Name: oauth_clients id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.oauth_clients ALTER COLUMN id SET DEFAULT nextval('public.oauth_clients_id_seq'::regclass);


--
-- TOC entry 3701 (class 2604 OID 18084)
-- Name: oauth_personal_access_clients id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.oauth_personal_access_clients ALTER COLUMN id SET DEFAULT nextval('public.oauth_personal_access_clients_id_seq'::regclass);


--
-- TOC entry 3702 (class 2604 OID 18085)
-- Name: ordinances id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ordinances ALTER COLUMN id SET DEFAULT nextval('public.ordinances_id_seq'::regclass);


--
-- TOC entry 3703 (class 2604 OID 18086)
-- Name: ownership_states id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ownership_states ALTER COLUMN id SET DEFAULT nextval('public.ownership_states_id_seq'::regclass);


--
-- TOC entry 3704 (class 2604 OID 18087)
-- Name: parishes id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.parishes ALTER COLUMN id SET DEFAULT nextval('public.parishes_id_seq'::regclass);


--
-- TOC entry 3705 (class 2604 OID 18088)
-- Name: payment_liquidation id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.payment_liquidation ALTER COLUMN id SET DEFAULT nextval('public.payment_liquidation_id_seq'::regclass);


--
-- TOC entry 3706 (class 2604 OID 18089)
-- Name: payment_methods id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.payment_methods ALTER COLUMN id SET DEFAULT nextval('public.payment_methods_id_seq'::regclass);


--
-- TOC entry 3707 (class 2604 OID 18090)
-- Name: payment_types id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.payment_types ALTER COLUMN id SET DEFAULT nextval('public.payment_types_id_seq'::regclass);


--
-- TOC entry 3708 (class 2604 OID 18091)
-- Name: payments id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.payments ALTER COLUMN id SET DEFAULT nextval('public.payments_id_seq'::regclass);


--
-- TOC entry 3709 (class 2604 OID 18092)
-- Name: people id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.people ALTER COLUMN id SET DEFAULT nextval('public.people_id_seq'::regclass);


--
-- TOC entry 3710 (class 2604 OID 18093)
-- Name: permission_role id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permission_role ALTER COLUMN id SET DEFAULT nextval('public.permission_role_id_seq'::regclass);


--
-- TOC entry 3711 (class 2604 OID 18094)
-- Name: permission_user id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permission_user ALTER COLUMN id SET DEFAULT nextval('public.permission_user_id_seq'::regclass);


--
-- TOC entry 3713 (class 2604 OID 18095)
-- Name: permissions id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permissions ALTER COLUMN id SET DEFAULT nextval('public.permissions_id_seq'::regclass);


--
-- TOC entry 3714 (class 2604 OID 18096)
-- Name: permits id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permits ALTER COLUMN id SET DEFAULT nextval('public.permits_id_seq'::regclass);


--
-- TOC entry 3715 (class 2604 OID 18097)
-- Name: personal_access_tokens id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('public.personal_access_tokens_id_seq'::regclass);


--
-- TOC entry 3716 (class 2604 OID 18098)
-- Name: petro_prices id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.petro_prices ALTER COLUMN id SET DEFAULT nextval('public.petro_prices_id_seq'::regclass);


--
-- TOC entry 3717 (class 2604 OID 18099)
-- Name: properties id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.properties ALTER COLUMN id SET DEFAULT nextval('public.properties_id_seq'::regclass);


--
-- TOC entry 3718 (class 2604 OID 18100)
-- Name: property_types id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.property_types ALTER COLUMN id SET DEFAULT nextval('public.property_types_id_seq'::regclass);


--
-- TOC entry 3719 (class 2604 OID 18101)
-- Name: reductions id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.reductions ALTER COLUMN id SET DEFAULT nextval('public.reductions_id_seq'::regclass);


--
-- TOC entry 3720 (class 2604 OID 18102)
-- Name: references id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."references" ALTER COLUMN id SET DEFAULT nextval('public.references_id_seq'::regclass);


--
-- TOC entry 3721 (class 2604 OID 18103)
-- Name: representation_types id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.representation_types ALTER COLUMN id SET DEFAULT nextval('public.representation_types_id_seq'::regclass);


--
-- TOC entry 3722 (class 2604 OID 18104)
-- Name: representations id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.representations ALTER COLUMN id SET DEFAULT nextval('public.representations_id_seq'::regclass);


--
-- TOC entry 3723 (class 2604 OID 18105)
-- Name: requirement_taxpayer id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.requirement_taxpayer ALTER COLUMN id SET DEFAULT nextval('public.requirement_taxpayer_id_seq'::regclass);


--
-- TOC entry 3724 (class 2604 OID 18106)
-- Name: requirements id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.requirements ALTER COLUMN id SET DEFAULT nextval('public.requirements_id_seq'::regclass);


--
-- TOC entry 3725 (class 2604 OID 18107)
-- Name: revenue_stamps id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.revenue_stamps ALTER COLUMN id SET DEFAULT nextval('public.revenue_stamps_id_seq'::regclass);


--
-- TOC entry 3726 (class 2604 OID 18108)
-- Name: role_user id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.role_user ALTER COLUMN id SET DEFAULT nextval('public.role_user_id_seq'::regclass);


--
-- TOC entry 3728 (class 2604 OID 18109)
-- Name: roles id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roles ALTER COLUMN id SET DEFAULT nextval('public.roles_id_seq'::regclass);


--
-- TOC entry 3731 (class 2604 OID 18110)
-- Name: signatures id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.signatures ALTER COLUMN id SET DEFAULT nextval('public.signatures_id_seq'::regclass);


--
-- TOC entry 3732 (class 2604 OID 18111)
-- Name: status id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.status ALTER COLUMN id SET DEFAULT nextval('public.status_id_seq'::regclass);


--
-- TOC entry 3733 (class 2604 OID 18112)
-- Name: tax_units id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tax_units ALTER COLUMN id SET DEFAULT nextval('public.tax_units_id_seq'::regclass);


--
-- TOC entry 3734 (class 2604 OID 18113)
-- Name: taxpayer_classifications id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.taxpayer_classifications ALTER COLUMN id SET DEFAULT nextval('public.taxpayer_classifications_id_seq'::regclass);


--
-- TOC entry 3735 (class 2604 OID 18114)
-- Name: taxpayer_property id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.taxpayer_property ALTER COLUMN id SET DEFAULT nextval('public.taxpayer_property_id_seq'::regclass);


--
-- TOC entry 3736 (class 2604 OID 18115)
-- Name: taxpayer_types id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.taxpayer_types ALTER COLUMN id SET DEFAULT nextval('public.taxpayer_types_id_seq'::regclass);


--
-- TOC entry 3737 (class 2604 OID 18116)
-- Name: taxpayers id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.taxpayers ALTER COLUMN id SET DEFAULT nextval('public.taxpayers_id_seq'::regclass);


--
-- TOC entry 3739 (class 2604 OID 18117)
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- TOC entry 3740 (class 2604 OID 18118)
-- Name: years id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.years ALTER COLUMN id SET DEFAULT nextval('public.years_id_seq'::regclass);


--
-- TOC entry 3742 (class 2606 OID 18120)
-- Name: account_types account_types_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.account_types
    ADD CONSTRAINT account_types_pkey PRIMARY KEY (id);


--
-- TOC entry 3744 (class 2606 OID 18122)
-- Name: accounting_accounts accounting_accounts_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.accounting_accounts
    ADD CONSTRAINT accounting_accounts_pkey PRIMARY KEY (id);


--
-- TOC entry 3746 (class 2606 OID 18124)
-- Name: accounts accounts_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.accounts
    ADD CONSTRAINT accounts_pkey PRIMARY KEY (id);


--
-- TOC entry 3748 (class 2606 OID 18126)
-- Name: activity_classifications activity_classifications_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.activity_classifications
    ADD CONSTRAINT activity_classifications_pkey PRIMARY KEY (id);


--
-- TOC entry 3750 (class 2606 OID 18128)
-- Name: affidavit_fine affidavit_fine_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.affidavit_fine
    ADD CONSTRAINT affidavit_fine_pkey PRIMARY KEY (id);


--
-- TOC entry 3754 (class 2606 OID 18130)
-- Name: annexed_liqueurs annexed_liqueurs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.annexed_liqueurs
    ADD CONSTRAINT annexed_liqueurs_pkey PRIMARY KEY (id);


--
-- TOC entry 3756 (class 2606 OID 18132)
-- Name: applications applications_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.applications
    ADD CONSTRAINT applications_pkey PRIMARY KEY (id);


--
-- TOC entry 3759 (class 2606 OID 18134)
-- Name: audits audits_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.audits
    ADD CONSTRAINT audits_pkey PRIMARY KEY (id);


--
-- TOC entry 3762 (class 2606 OID 18136)
-- Name: cancellation_types cancellation_types_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cancellation_types
    ADD CONSTRAINT cancellation_types_pkey PRIMARY KEY (id);


--
-- TOC entry 3764 (class 2606 OID 18138)
-- Name: cancellations cancellations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cancellations
    ADD CONSTRAINT cancellations_pkey PRIMARY KEY (id);


--
-- TOC entry 3766 (class 2606 OID 18140)
-- Name: charging_methods charging_methods_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.charging_methods
    ADD CONSTRAINT charging_methods_pkey PRIMARY KEY (id);


--
-- TOC entry 3768 (class 2606 OID 18142)
-- Name: citizenships citizenships_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.citizenships
    ADD CONSTRAINT citizenships_pkey PRIMARY KEY (id);


--
-- TOC entry 3770 (class 2606 OID 18144)
-- Name: commercial_denominations commercial_denominations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commercial_denominations
    ADD CONSTRAINT commercial_denominations_pkey PRIMARY KEY (id);


--
-- TOC entry 3772 (class 2606 OID 18146)
-- Name: commercial_registers commercial_registers_num_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commercial_registers
    ADD CONSTRAINT commercial_registers_num_unique UNIQUE (num);


--
-- TOC entry 3774 (class 2606 OID 18148)
-- Name: commercial_registers commercial_registers_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commercial_registers
    ADD CONSTRAINT commercial_registers_pkey PRIMARY KEY (id);


--
-- TOC entry 3776 (class 2606 OID 18150)
-- Name: communities communities_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.communities
    ADD CONSTRAINT communities_pkey PRIMARY KEY (id);


--
-- TOC entry 3778 (class 2606 OID 18152)
-- Name: community_parish community_parish_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.community_parish
    ADD CONSTRAINT community_parish_pkey PRIMARY KEY (id);


--
-- TOC entry 3780 (class 2606 OID 18154)
-- Name: concepts concepts_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.concepts
    ADD CONSTRAINT concepts_pkey PRIMARY KEY (id);


--
-- TOC entry 3782 (class 2606 OID 18156)
-- Name: correlative_numbers correlative_numbers_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.correlative_numbers
    ADD CONSTRAINT correlative_numbers_pkey PRIMARY KEY (id);


--
-- TOC entry 3784 (class 2606 OID 18158)
-- Name: correlative_types correlative_types_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.correlative_types
    ADD CONSTRAINT correlative_types_pkey PRIMARY KEY (id);


--
-- TOC entry 3786 (class 2606 OID 18160)
-- Name: correlatives correlatives_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.correlatives
    ADD CONSTRAINT correlatives_pkey PRIMARY KEY (id);


--
-- TOC entry 3788 (class 2606 OID 18162)
-- Name: credits credits_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.credits
    ADD CONSTRAINT credits_pkey PRIMARY KEY (id);


--
-- TOC entry 3792 (class 2606 OID 18164)
-- Name: dismissals dismissals_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dismissals
    ADD CONSTRAINT dismissals_pkey PRIMARY KEY (id);


--
-- TOC entry 3794 (class 2606 OID 18166)
-- Name: economic_activities economic_activities_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.economic_activities
    ADD CONSTRAINT economic_activities_pkey PRIMARY KEY (id);


--
-- TOC entry 3798 (class 2606 OID 18168)
-- Name: economic_activity_license economic_activity_license_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.economic_activity_license
    ADD CONSTRAINT economic_activity_license_pkey PRIMARY KEY (id);


--
-- TOC entry 3796 (class 2606 OID 18170)
-- Name: economic_activity_affidavit economic_activity_settlement_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.economic_activity_affidavit
    ADD CONSTRAINT economic_activity_settlement_pkey PRIMARY KEY (id);


--
-- TOC entry 3800 (class 2606 OID 18172)
-- Name: economic_activity_taxpayer economic_activity_taxpayer_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.economic_activity_taxpayer
    ADD CONSTRAINT economic_activity_taxpayer_pkey PRIMARY KEY (id);


--
-- TOC entry 3802 (class 2606 OID 18174)
-- Name: fines fines_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fines
    ADD CONSTRAINT fines_pkey PRIMARY KEY (id);


--
-- TOC entry 3804 (class 2606 OID 18176)
-- Name: leased_liqueurs leased_liqueurs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.leased_liqueurs
    ADD CONSTRAINT leased_liqueurs_pkey PRIMARY KEY (id);


--
-- TOC entry 3806 (class 2606 OID 18178)
-- Name: licenses licenses_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.licenses
    ADD CONSTRAINT licenses_pkey PRIMARY KEY (id);


--
-- TOC entry 3808 (class 2606 OID 18180)
-- Name: liqueur_annexes liqueur_annexes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.liqueur_annexes
    ADD CONSTRAINT liqueur_annexes_pkey PRIMARY KEY (id);


--
-- TOC entry 3810 (class 2606 OID 18182)
-- Name: liqueur_classifications liqueur_classifications_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.liqueur_classifications
    ADD CONSTRAINT liqueur_classifications_pkey PRIMARY KEY (id);


--
-- TOC entry 3812 (class 2606 OID 18184)
-- Name: liqueur_parameters liqueur_parameters_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.liqueur_parameters
    ADD CONSTRAINT liqueur_parameters_pkey PRIMARY KEY (id);


--
-- TOC entry 3814 (class 2606 OID 18186)
-- Name: liqueur_zones liqueur_zones_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.liqueur_zones
    ADD CONSTRAINT liqueur_zones_pkey PRIMARY KEY (id);


--
-- TOC entry 3816 (class 2606 OID 18188)
-- Name: liqueurs liqueurs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.liqueurs
    ADD CONSTRAINT liqueurs_pkey PRIMARY KEY (id);


--
-- TOC entry 3818 (class 2606 OID 18190)
-- Name: liquidation_types lists_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.liquidation_types
    ADD CONSTRAINT lists_pkey PRIMARY KEY (id);


--
-- TOC entry 3822 (class 2606 OID 18192)
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- TOC entry 3824 (class 2606 OID 18194)
-- Name: months months_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.months
    ADD CONSTRAINT months_pkey PRIMARY KEY (id);


--
-- TOC entry 3826 (class 2606 OID 18196)
-- Name: movements movements_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.movements
    ADD CONSTRAINT movements_pkey PRIMARY KEY (id);


--
-- TOC entry 3828 (class 2606 OID 18198)
-- Name: oauth_access_tokens oauth_access_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.oauth_access_tokens
    ADD CONSTRAINT oauth_access_tokens_pkey PRIMARY KEY (id);


--
-- TOC entry 3831 (class 2606 OID 18200)
-- Name: oauth_auth_codes oauth_auth_codes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.oauth_auth_codes
    ADD CONSTRAINT oauth_auth_codes_pkey PRIMARY KEY (id);


--
-- TOC entry 3834 (class 2606 OID 18202)
-- Name: oauth_clients oauth_clients_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.oauth_clients
    ADD CONSTRAINT oauth_clients_pkey PRIMARY KEY (id);


--
-- TOC entry 3837 (class 2606 OID 18204)
-- Name: oauth_personal_access_clients oauth_personal_access_clients_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.oauth_personal_access_clients
    ADD CONSTRAINT oauth_personal_access_clients_pkey PRIMARY KEY (id);


--
-- TOC entry 3839 (class 2606 OID 18206)
-- Name: oauth_refresh_tokens oauth_refresh_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.oauth_refresh_tokens
    ADD CONSTRAINT oauth_refresh_tokens_pkey PRIMARY KEY (id);


--
-- TOC entry 3841 (class 2606 OID 18208)
-- Name: ordinances ordinances_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ordinances
    ADD CONSTRAINT ordinances_pkey PRIMARY KEY (id);


--
-- TOC entry 3843 (class 2606 OID 18210)
-- Name: ownership_states ownership_states_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ownership_states
    ADD CONSTRAINT ownership_states_pkey PRIMARY KEY (id);


--
-- TOC entry 3845 (class 2606 OID 18212)
-- Name: parishes parishes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.parishes
    ADD CONSTRAINT parishes_pkey PRIMARY KEY (id);


--
-- TOC entry 3847 (class 2606 OID 18214)
-- Name: payment_liquidation payment_liquidation_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.payment_liquidation
    ADD CONSTRAINT payment_liquidation_pkey PRIMARY KEY (id);


--
-- TOC entry 3849 (class 2606 OID 18216)
-- Name: payment_methods payment_methods_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.payment_methods
    ADD CONSTRAINT payment_methods_pkey PRIMARY KEY (id);


--
-- TOC entry 3851 (class 2606 OID 18218)
-- Name: payment_types payment_types_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.payment_types
    ADD CONSTRAINT payment_types_pkey PRIMARY KEY (id);


--
-- TOC entry 3853 (class 2606 OID 18220)
-- Name: payments payments_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.payments
    ADD CONSTRAINT payments_pkey PRIMARY KEY (id);


--
-- TOC entry 3855 (class 2606 OID 18222)
-- Name: people people_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.people
    ADD CONSTRAINT people_pkey PRIMARY KEY (id);


--
-- TOC entry 3858 (class 2606 OID 18224)
-- Name: permission_role permission_role_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permission_role
    ADD CONSTRAINT permission_role_pkey PRIMARY KEY (id);


--
-- TOC entry 3862 (class 2606 OID 18226)
-- Name: permission_user permission_user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permission_user
    ADD CONSTRAINT permission_user_pkey PRIMARY KEY (id);


--
-- TOC entry 3865 (class 2606 OID 18228)
-- Name: permissions permissions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permissions
    ADD CONSTRAINT permissions_pkey PRIMARY KEY (id);


--
-- TOC entry 3867 (class 2606 OID 18230)
-- Name: permissions permissions_slug_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permissions
    ADD CONSTRAINT permissions_slug_unique UNIQUE (slug);


--
-- TOC entry 3869 (class 2606 OID 18232)
-- Name: permits permits_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permits
    ADD CONSTRAINT permits_pkey PRIMARY KEY (id);


--
-- TOC entry 3871 (class 2606 OID 18234)
-- Name: personal_access_tokens personal_access_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);


--
-- TOC entry 3873 (class 2606 OID 18236)
-- Name: personal_access_tokens personal_access_tokens_token_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);


--
-- TOC entry 3876 (class 2606 OID 18238)
-- Name: petro_prices petro_prices_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.petro_prices
    ADD CONSTRAINT petro_prices_pkey PRIMARY KEY (id);


--
-- TOC entry 3878 (class 2606 OID 18240)
-- Name: properties properties_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.properties
    ADD CONSTRAINT properties_pkey PRIMARY KEY (id);


--
-- TOC entry 3880 (class 2606 OID 18242)
-- Name: property_types property_types_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.property_types
    ADD CONSTRAINT property_types_pkey PRIMARY KEY (id);


--
-- TOC entry 3820 (class 2606 OID 18244)
-- Name: liquidations receivables_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.liquidations
    ADD CONSTRAINT receivables_pkey PRIMARY KEY (id);


--
-- TOC entry 3882 (class 2606 OID 18246)
-- Name: reductions reductions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.reductions
    ADD CONSTRAINT reductions_pkey PRIMARY KEY (id);


--
-- TOC entry 3884 (class 2606 OID 18248)
-- Name: references references_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."references"
    ADD CONSTRAINT references_pkey PRIMARY KEY (id);


--
-- TOC entry 3886 (class 2606 OID 18250)
-- Name: representation_types representation_types_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.representation_types
    ADD CONSTRAINT representation_types_pkey PRIMARY KEY (id);


--
-- TOC entry 3888 (class 2606 OID 18252)
-- Name: representations representations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.representations
    ADD CONSTRAINT representations_pkey PRIMARY KEY (id);


--
-- TOC entry 3890 (class 2606 OID 18254)
-- Name: requirement_taxpayer requirement_taxpayer_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.requirement_taxpayer
    ADD CONSTRAINT requirement_taxpayer_pkey PRIMARY KEY (id);


--
-- TOC entry 3892 (class 2606 OID 18256)
-- Name: requirements requirements_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.requirements
    ADD CONSTRAINT requirements_pkey PRIMARY KEY (id);


--
-- TOC entry 3894 (class 2606 OID 18258)
-- Name: revenue_stamps revenue_stamps_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.revenue_stamps
    ADD CONSTRAINT revenue_stamps_pkey PRIMARY KEY (id);


--
-- TOC entry 3896 (class 2606 OID 18260)
-- Name: role_user role_user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.role_user
    ADD CONSTRAINT role_user_pkey PRIMARY KEY (id);


--
-- TOC entry 3900 (class 2606 OID 18262)
-- Name: roles roles_name_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_name_unique UNIQUE (name);


--
-- TOC entry 3902 (class 2606 OID 18264)
-- Name: roles roles_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_pkey PRIMARY KEY (id);


--
-- TOC entry 3904 (class 2606 OID 18266)
-- Name: roles roles_slug_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_slug_unique UNIQUE (slug);


--
-- TOC entry 3752 (class 2606 OID 18268)
-- Name: affidavits settlements_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.affidavits
    ADD CONSTRAINT settlements_pkey PRIMARY KEY (id);


--
-- TOC entry 3906 (class 2606 OID 18270)
-- Name: signatures signatures_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.signatures
    ADD CONSTRAINT signatures_pkey PRIMARY KEY (id);


--
-- TOC entry 3908 (class 2606 OID 18272)
-- Name: status status_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.status
    ADD CONSTRAINT status_pkey PRIMARY KEY (id);


--
-- TOC entry 3910 (class 2606 OID 18274)
-- Name: tax_units tax_units_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tax_units
    ADD CONSTRAINT tax_units_pkey PRIMARY KEY (id);


--
-- TOC entry 3912 (class 2606 OID 18276)
-- Name: taxpayer_classifications taxpayer_classifications_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.taxpayer_classifications
    ADD CONSTRAINT taxpayer_classifications_pkey PRIMARY KEY (id);


--
-- TOC entry 3914 (class 2606 OID 18278)
-- Name: taxpayer_property taxpayer_property_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.taxpayer_property
    ADD CONSTRAINT taxpayer_property_pkey PRIMARY KEY (id);


--
-- TOC entry 3916 (class 2606 OID 18280)
-- Name: taxpayer_types taxpayer_types_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.taxpayer_types
    ADD CONSTRAINT taxpayer_types_pkey PRIMARY KEY (id);


--
-- TOC entry 3918 (class 2606 OID 18282)
-- Name: taxpayers taxpayers_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.taxpayers
    ADD CONSTRAINT taxpayers_pkey PRIMARY KEY (id);


--
-- TOC entry 3920 (class 2606 OID 18284)
-- Name: users users_login_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_login_unique UNIQUE (login);


--
-- TOC entry 3922 (class 2606 OID 18286)
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- TOC entry 3790 (class 2606 OID 18288)
-- Name: deductions withholdings_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.deductions
    ADD CONSTRAINT withholdings_pkey PRIMARY KEY (id);


--
-- TOC entry 3924 (class 2606 OID 18290)
-- Name: years years_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.years
    ADD CONSTRAINT years_pkey PRIMARY KEY (id);


--
-- TOC entry 3757 (class 1259 OID 18291)
-- Name: audits_auditable_type_auditable_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX audits_auditable_type_auditable_id_index ON public.audits USING btree (auditable_type, auditable_id);


--
-- TOC entry 3760 (class 1259 OID 18292)
-- Name: audits_user_id_user_type_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX audits_user_id_user_type_index ON public.audits USING btree (user_id, user_type);


--
-- TOC entry 3829 (class 1259 OID 18293)
-- Name: oauth_access_tokens_user_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX oauth_access_tokens_user_id_index ON public.oauth_access_tokens USING btree (user_id);


--
-- TOC entry 3832 (class 1259 OID 18294)
-- Name: oauth_auth_codes_user_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX oauth_auth_codes_user_id_index ON public.oauth_auth_codes USING btree (user_id);


--
-- TOC entry 3835 (class 1259 OID 18295)
-- Name: oauth_clients_user_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX oauth_clients_user_id_index ON public.oauth_clients USING btree (user_id);


--
-- TOC entry 3856 (class 1259 OID 18296)
-- Name: permission_role_permission_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX permission_role_permission_id_index ON public.permission_role USING btree (permission_id);


--
-- TOC entry 3859 (class 1259 OID 18297)
-- Name: permission_role_role_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX permission_role_role_id_index ON public.permission_role USING btree (role_id);


--
-- TOC entry 3860 (class 1259 OID 18298)
-- Name: permission_user_permission_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX permission_user_permission_id_index ON public.permission_user USING btree (permission_id);


--
-- TOC entry 3863 (class 1259 OID 18299)
-- Name: permission_user_user_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX permission_user_user_id_index ON public.permission_user USING btree (user_id);


--
-- TOC entry 3874 (class 1259 OID 18300)
-- Name: personal_access_tokens_tokenable_type_tokenable_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id);


--
-- TOC entry 3897 (class 1259 OID 18301)
-- Name: role_user_role_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX role_user_role_id_index ON public.role_user USING btree (role_id);


--
-- TOC entry 3898 (class 1259 OID 18302)
-- Name: role_user_user_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX role_user_user_id_index ON public.role_user USING btree (user_id);


--
-- TOC entry 3925 (class 2606 OID 18303)
-- Name: accounts accounts_account_type_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.accounts
    ADD CONSTRAINT accounts_account_type_id_foreign FOREIGN KEY (account_type_id) REFERENCES public.account_types(id);


--
-- TOC entry 3926 (class 2606 OID 18308)
-- Name: affidavit_fine affidavit_fine_affidavit_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.affidavit_fine
    ADD CONSTRAINT affidavit_fine_affidavit_id_foreign FOREIGN KEY (affidavit_id) REFERENCES public.affidavits(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3927 (class 2606 OID 18313)
-- Name: affidavit_fine affidavit_fine_fine_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.affidavit_fine
    ADD CONSTRAINT affidavit_fine_fine_id_foreign FOREIGN KEY (fine_id) REFERENCES public.fines(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3931 (class 2606 OID 18318)
-- Name: applications applications_concept_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.applications
    ADD CONSTRAINT applications_concept_id_foreign FOREIGN KEY (concept_id) REFERENCES public.concepts(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3932 (class 2606 OID 18323)
-- Name: applications applications_taxpayer_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.applications
    ADD CONSTRAINT applications_taxpayer_id_foreign FOREIGN KEY (taxpayer_id) REFERENCES public.taxpayers(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3933 (class 2606 OID 18328)
-- Name: applications applications_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.applications
    ADD CONSTRAINT applications_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3934 (class 2606 OID 18333)
-- Name: cancellations cancellations_cancellation_type_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cancellations
    ADD CONSTRAINT cancellations_cancellation_type_id_foreign FOREIGN KEY (cancellation_type_id) REFERENCES public.cancellation_types(id);


--
-- TOC entry 3935 (class 2606 OID 18338)
-- Name: cancellations cancellations_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cancellations
    ADD CONSTRAINT cancellations_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id);


--
-- TOC entry 3936 (class 2606 OID 18343)
-- Name: commercial_denominations commercial_denominations_taxpayer_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commercial_denominations
    ADD CONSTRAINT commercial_denominations_taxpayer_id_foreign FOREIGN KEY (taxpayer_id) REFERENCES public.taxpayers(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3937 (class 2606 OID 18348)
-- Name: commercial_registers commercial_registers_taxpayer_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commercial_registers
    ADD CONSTRAINT commercial_registers_taxpayer_id_foreign FOREIGN KEY (taxpayer_id) REFERENCES public.taxpayers(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3938 (class 2606 OID 18353)
-- Name: community_parish community_parish_community_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.community_parish
    ADD CONSTRAINT community_parish_community_id_foreign FOREIGN KEY (community_id) REFERENCES public.communities(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3939 (class 2606 OID 18358)
-- Name: community_parish community_parish_parish_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.community_parish
    ADD CONSTRAINT community_parish_parish_id_foreign FOREIGN KEY (parish_id) REFERENCES public.parishes(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3940 (class 2606 OID 18363)
-- Name: concepts concepts_accounting_account_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.concepts
    ADD CONSTRAINT concepts_accounting_account_id_foreign FOREIGN KEY (accounting_account_id) REFERENCES public.accounting_accounts(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3941 (class 2606 OID 18368)
-- Name: concepts concepts_charging_method_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.concepts
    ADD CONSTRAINT concepts_charging_method_id_foreign FOREIGN KEY (charging_method_id) REFERENCES public.charging_methods(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3942 (class 2606 OID 18373)
-- Name: concepts concepts_list_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.concepts
    ADD CONSTRAINT concepts_list_id_foreign FOREIGN KEY (liquidation_type_id) REFERENCES public.liquidation_types(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3943 (class 2606 OID 18378)
-- Name: concepts concepts_ordinance_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.concepts
    ADD CONSTRAINT concepts_ordinance_id_foreign FOREIGN KEY (ordinance_id) REFERENCES public.ordinances(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3944 (class 2606 OID 18383)
-- Name: correlatives correlatives_correlative_number_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.correlatives
    ADD CONSTRAINT correlatives_correlative_number_id_foreign FOREIGN KEY (correlative_number_id) REFERENCES public.correlative_numbers(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3945 (class 2606 OID 18388)
-- Name: correlatives correlatives_correlative_type_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.correlatives
    ADD CONSTRAINT correlatives_correlative_type_id_foreign FOREIGN KEY (correlative_type_id) REFERENCES public.correlative_types(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3946 (class 2606 OID 18393)
-- Name: correlatives correlatives_year_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.correlatives
    ADD CONSTRAINT correlatives_year_id_foreign FOREIGN KEY (year_id) REFERENCES public.years(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3947 (class 2606 OID 18398)
-- Name: credits credits_liquidation_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.credits
    ADD CONSTRAINT credits_liquidation_id_foreign FOREIGN KEY (liquidation_id) REFERENCES public.liquidations(id) ON DELETE CASCADE;


--
-- TOC entry 3948 (class 2606 OID 18403)
-- Name: credits credits_payment_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.credits
    ADD CONSTRAINT credits_payment_id_foreign FOREIGN KEY (payment_id) REFERENCES public.payments(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3949 (class 2606 OID 18408)
-- Name: credits credits_taxpayer_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.credits
    ADD CONSTRAINT credits_taxpayer_id_foreign FOREIGN KEY (taxpayer_id) REFERENCES public.taxpayers(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3950 (class 2606 OID 18413)
-- Name: deductions deductions_liquidation_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.deductions
    ADD CONSTRAINT deductions_liquidation_id_foreign FOREIGN KEY (liquidation_id) REFERENCES public.liquidations(id);


--
-- TOC entry 3951 (class 2606 OID 18418)
-- Name: deductions deductions_payment_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.deductions
    ADD CONSTRAINT deductions_payment_id_foreign FOREIGN KEY (payment_id) REFERENCES public.payments(id);


--
-- TOC entry 3953 (class 2606 OID 18423)
-- Name: dismissals dismissals_license_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dismissals
    ADD CONSTRAINT dismissals_license_id_foreign FOREIGN KEY (license_id) REFERENCES public.licenses(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3954 (class 2606 OID 18428)
-- Name: dismissals dismissals_taxpayer_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dismissals
    ADD CONSTRAINT dismissals_taxpayer_id_foreign FOREIGN KEY (taxpayer_id) REFERENCES public.taxpayers(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3955 (class 2606 OID 18433)
-- Name: dismissals dismissals_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dismissals
    ADD CONSTRAINT dismissals_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3956 (class 2606 OID 18438)
-- Name: economic_activities economic_activities_charging_method_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.economic_activities
    ADD CONSTRAINT economic_activities_charging_method_id_foreign FOREIGN KEY (charging_method_id) REFERENCES public.charging_methods(id);


--
-- TOC entry 3959 (class 2606 OID 18443)
-- Name: economic_activity_license economic_activity_license_economic_activity_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.economic_activity_license
    ADD CONSTRAINT economic_activity_license_economic_activity_id_foreign FOREIGN KEY (economic_activity_id) REFERENCES public.economic_activities(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3960 (class 2606 OID 18448)
-- Name: economic_activity_license economic_activity_license_license_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.economic_activity_license
    ADD CONSTRAINT economic_activity_license_license_id_foreign FOREIGN KEY (license_id) REFERENCES public.licenses(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3957 (class 2606 OID 18453)
-- Name: economic_activity_affidavit economic_activity_settlement_economic_activity_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.economic_activity_affidavit
    ADD CONSTRAINT economic_activity_settlement_economic_activity_id_foreign FOREIGN KEY (economic_activity_id) REFERENCES public.economic_activities(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3958 (class 2606 OID 18458)
-- Name: economic_activity_affidavit economic_activity_settlement_settlement_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.economic_activity_affidavit
    ADD CONSTRAINT economic_activity_settlement_settlement_id_foreign FOREIGN KEY (affidavit_id) REFERENCES public.affidavits(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3961 (class 2606 OID 18463)
-- Name: economic_activity_taxpayer economic_activity_taxpayer_economic_activity_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.economic_activity_taxpayer
    ADD CONSTRAINT economic_activity_taxpayer_economic_activity_id_foreign FOREIGN KEY (economic_activity_id) REFERENCES public.economic_activities(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3962 (class 2606 OID 18468)
-- Name: economic_activity_taxpayer economic_activity_taxpayer_taxpayer_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.economic_activity_taxpayer
    ADD CONSTRAINT economic_activity_taxpayer_taxpayer_id_foreign FOREIGN KEY (taxpayer_id) REFERENCES public.taxpayers(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3963 (class 2606 OID 18473)
-- Name: fines fines_concept_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fines
    ADD CONSTRAINT fines_concept_id_foreign FOREIGN KEY (concept_id) REFERENCES public.concepts(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3964 (class 2606 OID 18478)
-- Name: fines fines_taxpayer_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fines
    ADD CONSTRAINT fines_taxpayer_id_foreign FOREIGN KEY (taxpayer_id) REFERENCES public.taxpayers(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3965 (class 2606 OID 18483)
-- Name: fines fines_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fines
    ADD CONSTRAINT fines_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3966 (class 2606 OID 18488)
-- Name: leased_liqueurs leased_liqueurs_leaser_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.leased_liqueurs
    ADD CONSTRAINT leased_liqueurs_leaser_id_foreign FOREIGN KEY (leaser_id) REFERENCES public.taxpayers(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3967 (class 2606 OID 18493)
-- Name: leased_liqueurs leased_liqueurs_liqueur_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.leased_liqueurs
    ADD CONSTRAINT leased_liqueurs_liqueur_id_foreign FOREIGN KEY (liqueur_id) REFERENCES public.liqueurs(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3968 (class 2606 OID 18498)
-- Name: licenses licenses_correlative_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.licenses
    ADD CONSTRAINT licenses_correlative_id_foreign FOREIGN KEY (correlative_id) REFERENCES public.correlatives(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3969 (class 2606 OID 18503)
-- Name: licenses licenses_liquidation_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.licenses
    ADD CONSTRAINT licenses_liquidation_id_foreign FOREIGN KEY (liquidation_id) REFERENCES public.liquidations(id) ON DELETE CASCADE;


--
-- TOC entry 3970 (class 2606 OID 18508)
-- Name: licenses licenses_ordinance_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.licenses
    ADD CONSTRAINT licenses_ordinance_id_foreign FOREIGN KEY (ordinance_id) REFERENCES public.ordinances(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3971 (class 2606 OID 18513)
-- Name: licenses licenses_representation_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.licenses
    ADD CONSTRAINT licenses_representation_id_foreign FOREIGN KEY (representation_id) REFERENCES public.representations(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3972 (class 2606 OID 18518)
-- Name: licenses licenses_taxpayer_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.licenses
    ADD CONSTRAINT licenses_taxpayer_id_foreign FOREIGN KEY (taxpayer_id) REFERENCES public.taxpayers(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3973 (class 2606 OID 18523)
-- Name: licenses licenses_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.licenses
    ADD CONSTRAINT licenses_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3974 (class 2606 OID 18528)
-- Name: liqueur_annexes liqueur_annexes_annex_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.liqueur_annexes
    ADD CONSTRAINT liqueur_annexes_annex_id_foreign FOREIGN KEY (annex_id) REFERENCES public.annexed_liqueurs(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3975 (class 2606 OID 18533)
-- Name: liqueur_annexes liqueur_annexes_liqueur_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.liqueur_annexes
    ADD CONSTRAINT liqueur_annexes_liqueur_id_foreign FOREIGN KEY (liqueur_id) REFERENCES public.liqueurs(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3976 (class 2606 OID 18538)
-- Name: liqueur_parameters liqueur_parameters_charging_method_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.liqueur_parameters
    ADD CONSTRAINT liqueur_parameters_charging_method_id_foreign FOREIGN KEY (charging_method_id) REFERENCES public.charging_methods(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3977 (class 2606 OID 18543)
-- Name: liqueur_parameters liqueur_parameters_liqueur_classification_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.liqueur_parameters
    ADD CONSTRAINT liqueur_parameters_liqueur_classification_id_foreign FOREIGN KEY (liqueur_classification_id) REFERENCES public.liqueur_classifications(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3978 (class 2606 OID 18548)
-- Name: liqueur_parameters liqueur_parameters_liqueur_zone_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.liqueur_parameters
    ADD CONSTRAINT liqueur_parameters_liqueur_zone_id_foreign FOREIGN KEY (liqueur_zone_id) REFERENCES public.liqueur_zones(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3979 (class 2606 OID 18553)
-- Name: liqueurs liqueurs_license_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.liqueurs
    ADD CONSTRAINT liqueurs_license_id_foreign FOREIGN KEY (license_id) REFERENCES public.licenses(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3980 (class 2606 OID 18558)
-- Name: liqueurs liqueurs_liqueur_classification_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.liqueurs
    ADD CONSTRAINT liqueurs_liqueur_classification_id_foreign FOREIGN KEY (liqueur_classification_id) REFERENCES public.liqueur_classifications(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3981 (class 2606 OID 18563)
-- Name: liqueurs liqueurs_liqueur_parameter_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.liqueurs
    ADD CONSTRAINT liqueurs_liqueur_parameter_id_foreign FOREIGN KEY (liqueur_parameter_id) REFERENCES public.liqueur_parameters(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3982 (class 2606 OID 18568)
-- Name: liquidations liquidations_concept_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.liquidations
    ADD CONSTRAINT liquidations_concept_id_foreign FOREIGN KEY (concept_id) REFERENCES public.concepts(id);


--
-- TOC entry 3983 (class 2606 OID 18573)
-- Name: liquidations liquidations_liquidation_type_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.liquidations
    ADD CONSTRAINT liquidations_liquidation_type_id_foreign FOREIGN KEY (liquidation_type_id) REFERENCES public.liquidation_types(id);


--
-- TOC entry 3984 (class 2606 OID 18578)
-- Name: liquidations liquidations_status_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.liquidations
    ADD CONSTRAINT liquidations_status_id_foreign FOREIGN KEY (status_id) REFERENCES public.status(id);


--
-- TOC entry 3985 (class 2606 OID 18583)
-- Name: liquidations liquidations_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.liquidations
    ADD CONSTRAINT liquidations_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id);


--
-- TOC entry 3987 (class 2606 OID 18588)
-- Name: months months_year_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.months
    ADD CONSTRAINT months_year_id_foreign FOREIGN KEY (year_id) REFERENCES public.years(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3988 (class 2606 OID 18593)
-- Name: movements movements_concept_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.movements
    ADD CONSTRAINT movements_concept_id_foreign FOREIGN KEY (concept_id) REFERENCES public.concepts(id);


--
-- TOC entry 3989 (class 2606 OID 18598)
-- Name: movements movements_liquidation_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.movements
    ADD CONSTRAINT movements_liquidation_id_foreign FOREIGN KEY (liquidation_id) REFERENCES public.liquidations(id);


--
-- TOC entry 3990 (class 2606 OID 18603)
-- Name: movements movements_payment_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.movements
    ADD CONSTRAINT movements_payment_id_foreign FOREIGN KEY (payment_id) REFERENCES public.payments(id);


--
-- TOC entry 3991 (class 2606 OID 18608)
-- Name: movements movements_year_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.movements
    ADD CONSTRAINT movements_year_id_foreign FOREIGN KEY (year_id) REFERENCES public.years(id);


--
-- TOC entry 3992 (class 2606 OID 18613)
-- Name: payment_liquidation payment_liquidation_liquidation_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.payment_liquidation
    ADD CONSTRAINT payment_liquidation_liquidation_id_foreign FOREIGN KEY (liquidation_id) REFERENCES public.liquidations(id);


--
-- TOC entry 3993 (class 2606 OID 18618)
-- Name: payment_liquidation payment_liquidation_payment_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.payment_liquidation
    ADD CONSTRAINT payment_liquidation_payment_id_foreign FOREIGN KEY (payment_id) REFERENCES public.payments(id);


--
-- TOC entry 3994 (class 2606 OID 18623)
-- Name: payments payments_payment_method_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.payments
    ADD CONSTRAINT payments_payment_method_id_foreign FOREIGN KEY (payment_method_id) REFERENCES public.payment_methods(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3995 (class 2606 OID 18628)
-- Name: payments payments_payment_type_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.payments
    ADD CONSTRAINT payments_payment_type_id_foreign FOREIGN KEY (payment_type_id) REFERENCES public.payment_types(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3996 (class 2606 OID 18633)
-- Name: payments payments_state_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.payments
    ADD CONSTRAINT payments_state_id_foreign FOREIGN KEY (status_id) REFERENCES public.status(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3997 (class 2606 OID 18638)
-- Name: payments payments_taxpayer_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.payments
    ADD CONSTRAINT payments_taxpayer_id_foreign FOREIGN KEY (taxpayer_id) REFERENCES public.taxpayers(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3998 (class 2606 OID 18643)
-- Name: payments payments_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.payments
    ADD CONSTRAINT payments_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON UPDATE CASCADE;


--
-- TOC entry 3999 (class 2606 OID 18648)
-- Name: people people_citizenship_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.people
    ADD CONSTRAINT people_citizenship_id_foreign FOREIGN KEY (citizenship_id) REFERENCES public.citizenships(id);


--
-- TOC entry 4000 (class 2606 OID 18653)
-- Name: permission_role permission_role_permission_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permission_role
    ADD CONSTRAINT permission_role_permission_id_foreign FOREIGN KEY (permission_id) REFERENCES public.permissions(id) ON DELETE CASCADE;


--
-- TOC entry 4001 (class 2606 OID 18658)
-- Name: permission_role permission_role_role_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permission_role
    ADD CONSTRAINT permission_role_role_id_foreign FOREIGN KEY (role_id) REFERENCES public.roles(id) ON DELETE CASCADE;


--
-- TOC entry 4002 (class 2606 OID 18663)
-- Name: permission_user permission_user_permission_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permission_user
    ADD CONSTRAINT permission_user_permission_id_foreign FOREIGN KEY (permission_id) REFERENCES public.permissions(id) ON DELETE CASCADE;


--
-- TOC entry 4003 (class 2606 OID 18668)
-- Name: permission_user permission_user_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permission_user
    ADD CONSTRAINT permission_user_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- TOC entry 4004 (class 2606 OID 18673)
-- Name: permits permits_concept_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permits
    ADD CONSTRAINT permits_concept_id_foreign FOREIGN KEY (concept_id) REFERENCES public.concepts(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 4005 (class 2606 OID 18678)
-- Name: permits permits_taxpayer_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permits
    ADD CONSTRAINT permits_taxpayer_id_foreign FOREIGN KEY (taxpayer_id) REFERENCES public.taxpayers(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 4006 (class 2606 OID 18683)
-- Name: permits permits_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permits
    ADD CONSTRAINT permits_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 4007 (class 2606 OID 18688)
-- Name: properties properties_property_type_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.properties
    ADD CONSTRAINT properties_property_type_id_foreign FOREIGN KEY (property_type_id) REFERENCES public.property_types(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 4008 (class 2606 OID 18693)
-- Name: property_types property_types_charging_method_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.property_types
    ADD CONSTRAINT property_types_charging_method_id_foreign FOREIGN KEY (charging_method_id) REFERENCES public.charging_methods(id);


--
-- TOC entry 4009 (class 2606 OID 18698)
-- Name: references references_account_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."references"
    ADD CONSTRAINT references_account_id_foreign FOREIGN KEY (account_id) REFERENCES public.accounts(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 4010 (class 2606 OID 18703)
-- Name: references references_payment_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."references"
    ADD CONSTRAINT references_payment_id_foreign FOREIGN KEY (payment_id) REFERENCES public.payments(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 4011 (class 2606 OID 18708)
-- Name: representations representations_person_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.representations
    ADD CONSTRAINT representations_person_id_foreign FOREIGN KEY (person_id) REFERENCES public.people(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 4012 (class 2606 OID 18713)
-- Name: representations representations_representation_type_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.representations
    ADD CONSTRAINT representations_representation_type_id_foreign FOREIGN KEY (representation_type_id) REFERENCES public.representation_types(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 4013 (class 2606 OID 18718)
-- Name: representations representations_taxpayer_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.representations
    ADD CONSTRAINT representations_taxpayer_id_foreign FOREIGN KEY (taxpayer_id) REFERENCES public.taxpayers(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 4014 (class 2606 OID 18723)
-- Name: requirement_taxpayer requirement_taxpayer_liquidation_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.requirement_taxpayer
    ADD CONSTRAINT requirement_taxpayer_liquidation_id_foreign FOREIGN KEY (liquidation_id) REFERENCES public.liquidations(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 4015 (class 2606 OID 18728)
-- Name: requirement_taxpayer requirement_taxpayer_requirement_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.requirement_taxpayer
    ADD CONSTRAINT requirement_taxpayer_requirement_id_foreign FOREIGN KEY (requirement_id) REFERENCES public.requirements(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 4016 (class 2606 OID 18733)
-- Name: requirement_taxpayer requirement_taxpayer_taxpayer_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.requirement_taxpayer
    ADD CONSTRAINT requirement_taxpayer_taxpayer_id_foreign FOREIGN KEY (taxpayer_id) REFERENCES public.taxpayers(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 4017 (class 2606 OID 18738)
-- Name: requirements requirements_concept_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.requirements
    ADD CONSTRAINT requirements_concept_id_foreign FOREIGN KEY (concept_id) REFERENCES public.concepts(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 4018 (class 2606 OID 18743)
-- Name: revenue_stamps revenue_stamps_license_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.revenue_stamps
    ADD CONSTRAINT revenue_stamps_license_id_foreign FOREIGN KEY (license_id) REFERENCES public.licenses(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 4019 (class 2606 OID 18748)
-- Name: revenue_stamps revenue_stamps_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.revenue_stamps
    ADD CONSTRAINT revenue_stamps_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 4020 (class 2606 OID 18753)
-- Name: role_user role_user_role_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.role_user
    ADD CONSTRAINT role_user_role_id_foreign FOREIGN KEY (role_id) REFERENCES public.roles(id) ON DELETE CASCADE;


--
-- TOC entry 4021 (class 2606 OID 18758)
-- Name: role_user role_user_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.role_user
    ADD CONSTRAINT role_user_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- TOC entry 3928 (class 2606 OID 18763)
-- Name: affidavits settlements_month_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.affidavits
    ADD CONSTRAINT settlements_month_id_foreign FOREIGN KEY (month_id) REFERENCES public.months(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3929 (class 2606 OID 18768)
-- Name: affidavits settlements_taxpayer_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.affidavits
    ADD CONSTRAINT settlements_taxpayer_id_foreign FOREIGN KEY (taxpayer_id) REFERENCES public.taxpayers(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3986 (class 2606 OID 18773)
-- Name: liquidations settlements_taxpayer_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.liquidations
    ADD CONSTRAINT settlements_taxpayer_id_foreign FOREIGN KEY (taxpayer_id) REFERENCES public.taxpayers(id);


--
-- TOC entry 3930 (class 2606 OID 18778)
-- Name: affidavits settlements_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.affidavits
    ADD CONSTRAINT settlements_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 4022 (class 2606 OID 18783)
-- Name: signatures signatures_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.signatures
    ADD CONSTRAINT signatures_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 4023 (class 2606 OID 18788)
-- Name: taxpayer_property taxpayer_property_ownership_state_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.taxpayer_property
    ADD CONSTRAINT taxpayer_property_ownership_state_id_foreign FOREIGN KEY (ownership_state_id) REFERENCES public.ownership_states(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 4024 (class 2606 OID 18793)
-- Name: taxpayer_property taxpayer_property_property_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.taxpayer_property
    ADD CONSTRAINT taxpayer_property_property_id_foreign FOREIGN KEY (property_id) REFERENCES public.properties(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 4025 (class 2606 OID 18798)
-- Name: taxpayer_property taxpayer_property_taxpayer_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.taxpayer_property
    ADD CONSTRAINT taxpayer_property_taxpayer_id_foreign FOREIGN KEY (taxpayer_id) REFERENCES public.taxpayers(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 4026 (class 2606 OID 18803)
-- Name: taxpayers taxpayers_community_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.taxpayers
    ADD CONSTRAINT taxpayers_community_id_foreign FOREIGN KEY (community_id) REFERENCES public.communities(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 4027 (class 2606 OID 18808)
-- Name: taxpayers taxpayers_taxpayer_classification_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.taxpayers
    ADD CONSTRAINT taxpayers_taxpayer_classification_id_foreign FOREIGN KEY (taxpayer_classification_id) REFERENCES public.taxpayer_classifications(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 4028 (class 2606 OID 18813)
-- Name: taxpayers taxpayers_taxpayer_type_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.taxpayers
    ADD CONSTRAINT taxpayers_taxpayer_type_id_foreign FOREIGN KEY (taxpayer_type_id) REFERENCES public.taxpayer_types(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3952 (class 2606 OID 18818)
-- Name: deductions withholdings_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.deductions
    ADD CONSTRAINT withholdings_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON UPDATE CASCADE ON DELETE CASCADE;


-- Completed on 2024-02-28 13:54:38 -04

--
-- PostgreSQL database dump complete
--

