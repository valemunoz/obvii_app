--
-- PostgreSQL database dump
--

-- Dumped from database version 9.2.4
-- Dumped by pg_dump version 9.2.4
-- Started on 2014-09-08 15:21:08

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 199 (class 1259 OID 142637)
-- Name: obvii_administrador; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE obvii_administrador (
    id_usuario_admin integer NOT NULL,
    nombre character varying,
    mail character varying(300),
    clave character varying(100),
    estado numeric DEFAULT 0,
    fecha_registro timestamp without time zone
);


ALTER TABLE public.obvii_administrador OWNER TO postgres;

--
-- TOC entry 198 (class 1259 OID 142635)
-- Name: obvii_administrador_id_usuario_admin_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE obvii_administrador_id_usuario_admin_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.obvii_administrador_id_usuario_admin_seq OWNER TO postgres;

--
-- TOC entry 3215 (class 0 OID 0)
-- Dependencies: 198
-- Name: obvii_administrador_id_usuario_admin_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE obvii_administrador_id_usuario_admin_seq OWNED BY obvii_administrador.id_usuario_admin;


--
-- TOC entry 193 (class 1259 OID 142606)
-- Name: obvii_cliente; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE obvii_cliente (
    id_cliente integer NOT NULL,
    nombre character varying(300),
    estado numeric DEFAULT 0,
    mail character varying(300),
    pais character varying(200),
    tipo numeric DEFAULT 0
);


ALTER TABLE public.obvii_cliente OWNER TO postgres;

--
-- TOC entry 3216 (class 0 OID 0)
-- Dependencies: 193
-- Name: COLUMN obvii_cliente.tipo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN obvii_cliente.tipo IS '0=normal
1=asitencia+ lista alumno';


--
-- TOC entry 192 (class 1259 OID 142604)
-- Name: obvii_cliente_id_cliente_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE obvii_cliente_id_cliente_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.obvii_cliente_id_cliente_seq OWNER TO postgres;

--
-- TOC entry 3217 (class 0 OID 0)
-- Dependencies: 192
-- Name: obvii_cliente_id_cliente_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE obvii_cliente_id_cliente_seq OWNED BY obvii_cliente.id_cliente;


--
-- TOC entry 195 (class 1259 OID 142614)
-- Name: obvii_favorito; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE obvii_favorito (
    id_favorito integer NOT NULL,
    id_usuario character varying(300),
    id_usuario_obvii numeric,
    id_lugar numeric,
    fecha_registro timestamp without time zone,
    estado numeric
);


ALTER TABLE public.obvii_favorito OWNER TO postgres;

--
-- TOC entry 194 (class 1259 OID 142612)
-- Name: obvii_favorito_id_favorito_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE obvii_favorito_id_favorito_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.obvii_favorito_id_favorito_seq OWNER TO postgres;

--
-- TOC entry 3218 (class 0 OID 0)
-- Dependencies: 194
-- Name: obvii_favorito_id_favorito_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE obvii_favorito_id_favorito_seq OWNED BY obvii_favorito.id_favorito;


--
-- TOC entry 189 (class 1259 OID 134394)
-- Name: obvii_lugares; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE obvii_lugares (
    id_lugar integer NOT NULL,
    nombre character varying(300),
    fecha_registro timestamp without time zone,
    estado numeric,
    latitud numeric,
    longitud numeric,
    calle character varying(300),
    numero_municipal numeric,
    comuna character varying(300),
    geom geometry,
    mail_post character varying(300),
    id_usuario character varying(300),
    comentario boolean,
    marcacion boolean,
    id_cliente numeric,
    mail_lista character varying(300)
);


ALTER TABLE public.obvii_lugares OWNER TO postgres;

--
-- TOC entry 3219 (class 0 OID 0)
-- Dependencies: 189
-- Name: COLUMN obvii_lugares.estado; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN obvii_lugares.estado IS '0=activo
1=inactivo';


--
-- TOC entry 188 (class 1259 OID 134392)
-- Name: obvii_lugares_id_lugar_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE obvii_lugares_id_lugar_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.obvii_lugares_id_lugar_seq OWNER TO postgres;

--
-- TOC entry 3220 (class 0 OID 0)
-- Dependencies: 188
-- Name: obvii_lugares_id_lugar_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE obvii_lugares_id_lugar_seq OWNED BY obvii_lugares.id_lugar;


--
-- TOC entry 191 (class 1259 OID 134405)
-- Name: obvii_marcacion; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE obvii_marcacion (
    id_marcacion integer NOT NULL,
    id_usuario character varying(300),
    id_usuario_obvii numeric,
    fecha_registro timestamp without time zone,
    tipo numeric,
    id_lugar numeric,
    lat numeric,
    lon numeric,
    presicion double precision,
    comentario character varying(300),
    tipo_marcacion numeric,
    nombre_lugar character varying(300),
    id_cliente numeric,
    direccion_libre character varying(500)
);


ALTER TABLE public.obvii_marcacion OWNER TO postgres;

--
-- TOC entry 3221 (class 0 OID 0)
-- Dependencies: 191
-- Name: COLUMN obvii_marcacion.tipo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN obvii_marcacion.tipo IS '0 tipico
1: marcacion libre
';


--
-- TOC entry 3222 (class 0 OID 0)
-- Dependencies: 191
-- Name: COLUMN obvii_marcacion.tipo_marcacion; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN obvii_marcacion.tipo_marcacion IS '0=entrada
1=salida';


--
-- TOC entry 190 (class 1259 OID 134403)
-- Name: obvii_marcacion_id_marcacion_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE obvii_marcacion_id_marcacion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.obvii_marcacion_id_marcacion_seq OWNER TO postgres;

--
-- TOC entry 3223 (class 0 OID 0)
-- Dependencies: 190
-- Name: obvii_marcacion_id_marcacion_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE obvii_marcacion_id_marcacion_seq OWNED BY obvii_marcacion.id_marcacion;


--
-- TOC entry 205 (class 1259 OID 159033)
-- Name: obvii_marcacion_interna; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE obvii_marcacion_interna (
    id_marca integer NOT NULL,
    id_usuario numeric,
    fecha_registro timestamp without time zone,
    id_lugar numeric,
    asiste boolean,
    estado numeric,
    id_marca_base numeric
);


ALTER TABLE public.obvii_marcacion_interna OWNER TO postgres;

--
-- TOC entry 204 (class 1259 OID 159031)
-- Name: obvii_marcacion_interna_id_marca_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE obvii_marcacion_interna_id_marca_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.obvii_marcacion_interna_id_marca_seq OWNER TO postgres;

--
-- TOC entry 3224 (class 0 OID 0)
-- Dependencies: 204
-- Name: obvii_marcacion_interna_id_marca_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE obvii_marcacion_interna_id_marca_seq OWNED BY obvii_marcacion_interna.id_marca;


--
-- TOC entry 201 (class 1259 OID 150904)
-- Name: obvii_pais; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE obvii_pais (
    id_pais integer NOT NULL,
    nombre character varying(300),
    estado numeric
);


ALTER TABLE public.obvii_pais OWNER TO postgres;

--
-- TOC entry 200 (class 1259 OID 150902)
-- Name: obvii_pais_id_pais_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE obvii_pais_id_pais_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.obvii_pais_id_pais_seq OWNER TO postgres;

--
-- TOC entry 3225 (class 0 OID 0)
-- Dependencies: 200
-- Name: obvii_pais_id_pais_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE obvii_pais_id_pais_seq OWNED BY obvii_pais.id_pais;


--
-- TOC entry 197 (class 1259 OID 142625)
-- Name: obvii_usuario; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE obvii_usuario (
    id_usuario integer NOT NULL,
    mail character varying(300),
    fecha_registro time without time zone,
    estado numeric,
    id_cliente numeric,
    tipo_usuario numeric,
    clave character varying,
    nombre character varying(300),
    id_usuario_obvii numeric
);


ALTER TABLE public.obvii_usuario OWNER TO postgres;

--
-- TOC entry 3226 (class 0 OID 0)
-- Dependencies: 197
-- Name: COLUMN obvii_usuario.tipo_usuario; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN obvii_usuario.tipo_usuario IS '1: admin
0:simple';


--
-- TOC entry 196 (class 1259 OID 142623)
-- Name: obvii_usuario_id_usuario_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE obvii_usuario_id_usuario_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.obvii_usuario_id_usuario_seq OWNER TO postgres;

--
-- TOC entry 3227 (class 0 OID 0)
-- Dependencies: 196
-- Name: obvii_usuario_id_usuario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE obvii_usuario_id_usuario_seq OWNED BY obvii_usuario.id_usuario;


--
-- TOC entry 203 (class 1259 OID 159022)
-- Name: obvii_usuarios_internos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE obvii_usuarios_internos (
    id_usuario_interno integer NOT NULL,
    nombre character varying(300),
    estado numeric,
    id_lugar numeric,
    fecha_registro timestamp without time zone,
    tipo numeric DEFAULT 1,
    descripcion character varying(2000)
);


ALTER TABLE public.obvii_usuarios_internos OWNER TO postgres;

--
-- TOC entry 3228 (class 0 OID 0)
-- Dependencies: 203
-- Name: COLUMN obvii_usuarios_internos.tipo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN obvii_usuarios_internos.tipo IS '1=persona
2=proceso';


--
-- TOC entry 202 (class 1259 OID 159020)
-- Name: obvii_usuarios_internos_id_usuario_interno_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE obvii_usuarios_internos_id_usuario_interno_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.obvii_usuarios_internos_id_usuario_interno_seq OWNER TO postgres;

--
-- TOC entry 3229 (class 0 OID 0)
-- Dependencies: 202
-- Name: obvii_usuarios_internos_id_usuario_interno_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE obvii_usuarios_internos_id_usuario_interno_seq OWNED BY obvii_usuarios_internos.id_usuario_interno;


--
-- TOC entry 3169 (class 2604 OID 142640)
-- Name: id_usuario_admin; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY obvii_administrador ALTER COLUMN id_usuario_admin SET DEFAULT nextval('obvii_administrador_id_usuario_admin_seq'::regclass);


--
-- TOC entry 3164 (class 2604 OID 142609)
-- Name: id_cliente; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY obvii_cliente ALTER COLUMN id_cliente SET DEFAULT nextval('obvii_cliente_id_cliente_seq'::regclass);


--
-- TOC entry 3167 (class 2604 OID 142617)
-- Name: id_favorito; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY obvii_favorito ALTER COLUMN id_favorito SET DEFAULT nextval('obvii_favorito_id_favorito_seq'::regclass);


--
-- TOC entry 3162 (class 2604 OID 134397)
-- Name: id_lugar; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY obvii_lugares ALTER COLUMN id_lugar SET DEFAULT nextval('obvii_lugares_id_lugar_seq'::regclass);


--
-- TOC entry 3163 (class 2604 OID 134408)
-- Name: id_marcacion; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY obvii_marcacion ALTER COLUMN id_marcacion SET DEFAULT nextval('obvii_marcacion_id_marcacion_seq'::regclass);


--
-- TOC entry 3174 (class 2604 OID 159036)
-- Name: id_marca; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY obvii_marcacion_interna ALTER COLUMN id_marca SET DEFAULT nextval('obvii_marcacion_interna_id_marca_seq'::regclass);


--
-- TOC entry 3171 (class 2604 OID 150907)
-- Name: id_pais; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY obvii_pais ALTER COLUMN id_pais SET DEFAULT nextval('obvii_pais_id_pais_seq'::regclass);


--
-- TOC entry 3168 (class 2604 OID 142628)
-- Name: id_usuario; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY obvii_usuario ALTER COLUMN id_usuario SET DEFAULT nextval('obvii_usuario_id_usuario_seq'::regclass);


--
-- TOC entry 3172 (class 2604 OID 159025)
-- Name: id_usuario_interno; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY obvii_usuarios_internos ALTER COLUMN id_usuario_interno SET DEFAULT nextval('obvii_usuarios_internos_id_usuario_interno_seq'::regclass);


-- Completed on 2014-09-08 15:21:08

--
-- PostgreSQL database dump complete
--

