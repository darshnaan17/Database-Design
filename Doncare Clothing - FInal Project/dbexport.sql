--
-- PostgreSQL database dump
--

-- Dumped from database version 14.1
-- Dumped by pg_dump version 14.2

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
-- Name: addresses; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.addresses (
    addressid character varying(13) NOT NULL,
    city character varying(50) NOT NULL,
    state character varying(50) NOT NULL,
    zip character varying(10) NOT NULL,
    address character varying(70)
);


ALTER TABLE public.addresses OWNER TO postgres;

--
-- Name: customers; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.customers (
    "custID" character varying(13) NOT NULL,
    name character varying(50) NOT NULL,
    email character varying(50) NOT NULL,
    "prodID" integer NOT NULL,
    addressid character varying(13)
);


ALTER TABLE public.customers OWNER TO postgres;

--
-- Name: have; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.have (
    email character varying(120) NOT NULL,
    addressid character varying(13) NOT NULL
);


ALTER TABLE public.have OWNER TO postgres;

--
-- Name: products; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.products (
    productid integer NOT NULL,
    productname character varying(50) NOT NULL,
    category character varying(50) NOT NULL,
    price real NOT NULL,
    instock character varying(20) NOT NULL,
    quantity integer NOT NULL
);


ALTER TABLE public.products OWNER TO postgres;

--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    email character varying(120) NOT NULL,
    password character varying(255) NOT NULL
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Data for Name: addresses; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.addresses (addressid, city, state, zip, address) FROM stdin;
\.


--
-- Data for Name: customers; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.customers ("custID", name, email, "prodID", addressid) FROM stdin;
\.


--
-- Data for Name: have; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.have (email, addressid) FROM stdin;
\.


--
-- Data for Name: products; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.products (productid, productname, category, price, instock, quantity) FROM stdin;
2	CASINO VARSITY JACKET	jacket	100	yes	12
5	test	test	0	no	0
4	DENIM JACKET	jacket	200	yes	25
3	COLLEGE JACKET	jacket	200	yes	34
1	CLASSIC MA-1 JACKET	jacket	150	yes	21
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (email, password) FROM stdin;
\.


--
-- Name: addresses addresses_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.addresses
    ADD CONSTRAINT addresses_pkey PRIMARY KEY (addressid);


--
-- Name: customers customers2_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.customers
    ADD CONSTRAINT customers2_pkey PRIMARY KEY ("custID");


--
-- Name: have have_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.have
    ADD CONSTRAINT have_pkey PRIMARY KEY (email, addressid);


--
-- Name: products products_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_pkey PRIMARY KEY (productid);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (email);


--
-- Name: customers customers2_addressid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.customers
    ADD CONSTRAINT customers2_addressid_fkey FOREIGN KEY (addressid) REFERENCES public.addresses(addressid) NOT VALID;


--
-- Name: customers customers2_prodID_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.customers
    ADD CONSTRAINT "customers2_prodID_fkey" FOREIGN KEY ("prodID") REFERENCES public.products(productid) NOT VALID;


--
-- Name: have fk2; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.have
    ADD CONSTRAINT fk2 FOREIGN KEY (email) REFERENCES public.users(email);


--
-- Name: have pk1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.have
    ADD CONSTRAINT pk1 FOREIGN KEY (addressid) REFERENCES public.addresses(addressid);


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: postgres
--

GRANT USAGE ON SCHEMA public TO readaccess;


--
-- Name: TABLE addresses; Type: ACL; Schema: public; Owner: postgres
--

GRANT SELECT ON TABLE public.addresses TO readaccess;
GRANT SELECT,INSERT,UPDATE ON TABLE public.addresses TO write_user;


--
-- Name: TABLE customers; Type: ACL; Schema: public; Owner: postgres
--

GRANT SELECT ON TABLE public.customers TO readaccess;
GRANT SELECT,INSERT,UPDATE ON TABLE public.customers TO write_user;


--
-- Name: TABLE have; Type: ACL; Schema: public; Owner: postgres
--

GRANT SELECT ON TABLE public.have TO readaccess;
GRANT SELECT,INSERT,UPDATE ON TABLE public.have TO write_user;


--
-- Name: TABLE products; Type: ACL; Schema: public; Owner: postgres
--

GRANT SELECT ON TABLE public.products TO readaccess;
GRANT SELECT,INSERT,UPDATE ON TABLE public.products TO write_user;


--
-- Name: TABLE users; Type: ACL; Schema: public; Owner: postgres
--

GRANT SELECT ON TABLE public.users TO readaccess;
GRANT SELECT,INSERT,UPDATE ON TABLE public.users TO write_user;


--
-- Name: DEFAULT PRIVILEGES FOR FUNCTIONS; Type: DEFAULT ACL; Schema: public; Owner: postgres
--

ALTER DEFAULT PRIVILEGES FOR ROLE postgres IN SCHEMA public GRANT ALL ON FUNCTIONS  TO write_user;


--
-- Name: DEFAULT PRIVILEGES FOR TABLES; Type: DEFAULT ACL; Schema: public; Owner: postgres
--

ALTER DEFAULT PRIVILEGES FOR ROLE postgres IN SCHEMA public GRANT SELECT,INSERT,UPDATE ON TABLES  TO write_user;


--
-- PostgreSQL database dump complete
--

